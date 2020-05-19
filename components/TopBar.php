<?php namespace RomainMazB\FEModelEditor\Components;

use Backend\Facades\BackendAuth;
use Illuminate\Support\Str;
use RomainMazB\FEModelEditor\Models\FEMEModel;

class TopBar extends \Cms\Classes\ComponentBase
{
    public bool $loggedIn = false;

    public function init()
    {
        if (! BackendAuth::check()) {
            return;
        }

        $this->loggedIn = true;
        $this->addCss('/plugins/romainmazb/femodeleditor/assets/css/topbar.css');

        $FEMEModels =
            FEMEModel::whereRaw("JSON_SEARCH(pages_names, 'one', ?) is not null", $this->page->id)->get()
        ;
        $page = $this;
        $this->page['FEMENavigationMenus'] = $FEMEModels->mapWithKeys(static function ($model) use ($page) {
            $full_model_name = '\\'. $model->namespace . '\\models\\' . $model->model_name;
            $navigation = [];
            $backend_url = config('app.url') . '/' . config('cms.backendUri') . '/';
            $namespace_url = strtolower(str_replace('\\', '/', $model->namespace)) . '/';
            $model_url = Str::slug(Str::plural($model->model_name)) . '/';
            $displayed_model = $full_model_name::select('id')
                                                ->where($model->url_param, $page->param($model->url_param))
                                                ->first();

            foreach ($model->displayed_actions as $action) {
                $action = Str::after($action, 'labels.');

                // Delete action is triggered from update form
                $action_to_trigger = $action === 'delete' ? 'update' : $action;
                $model_action_url = $backend_url . $namespace_url . $model_url . $action_to_trigger;
                if (in_array($action, ['preview', 'update', 'delete'])) {
                    if ($displayed_model !== null) {
                        $model_action_url .= '/' . $displayed_model->id;
                        $navigation[$action] = $model_action_url;
                    }
                } else {
                    $navigation[$action] = $model_action_url;
                }
            }
            return [$model->link_text => $navigation];
        });
    }

    public function componentDetails()
    {
        return [
            'name' => 'FrontEnd Model Editor Top Bar',
            'description' => 'Displays a top bar to create front-end shortcuts to backend model edit',
        ];
    }
}
