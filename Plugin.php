<?php

namespace RomainMazB\FEModelEditor;

use Backend\Facades\Backend;
use Illuminate\Support\Str;
use RomainMazB\FEModelEditor\Models\FEMEModel;
use System\Classes\PluginBase;
use Event;
use System\Classes\SettingsManager;

class Plugin extends PluginBase
{
    public $require = ['RomainMazB.AdminBar'];

    public function boot()
    {
        Event::listen('romainmazb.adminbar.init', function ($adminBar, &$items) {
            $links = $this->generateLinksForPage($adminBar->getController());
            $items = array_merge($items, $links);
        });
    }

    protected function generateLinksForPage($controller)
    {
        $page = $controller->getPage();
        // Load the model needed for this page
        $FEMEModels =
            FEMEModel::whereRaw("JSON_SEARCH(pages_names, 'one', ?) is not null", $page->id)->get()
        ;

        // Generate the links for the adminBar plugin
        $adminBar_items = $FEMEModels->map(static function ($model) use ($controller) {
            $full_model_name = '\\'. $model->namespace . '\\models\\' . $model->model_name;

            // Create a submenu for each model
            $navigation = [
                'type' => 'submenu',
                'text' => $model->link_text,
                'title' => 'title dada',
                'items' => []
            ];

            // Create the backend plugin model base url
            $backend_url = config('app.url') . '/' . config('cms.backendUri') . '/';
            $namespace_url = strtolower(str_replace('\\', '/', $model->namespace)) . '/';
            $model_url = Str::slug(Str::plural($model->model_name)) . '/';

            $displayed_model = $full_model_name::select('id')
                ->where($model->url_param, $controller->param($model->url_param))
                ->first();

            foreach ($model->displayed_actions as $action) {
                $action = Str::after($action, 'labels.');

                // Delete action is triggered from update form
                $action_to_trigger = $action === 'delete' ? 'update' : $action;
                $model_action_url = $backend_url . $namespace_url . $model_url . $action_to_trigger;

                $link_text = trans('backend::lang.relation.' . $action);
                // Search and provide id for preview/update/delete actions
                if (in_array($action, ['preview', 'update', 'delete'])) {
                    if ($displayed_model !== null) {
                        $model_action_url .= '/' . $displayed_model->id;

                        // Delete action need a ajax call
                        if ($action === 'delete') {
                            $navigation['items'][] = [
                                'type' => 'ajaxLink',
                                'text' => $link_text,
                                'form_action' => 'onDelete',
                                'datas' => [
                                    'request' => "onDelete",
                                    'request-url' => $model_action_url,
                                    'request-confirm' => trans('backend::lang.form.confirm_delete'),
                                ]
                            ];
                        } else {
                            $navigation['items'][] = [
                                'text' => $link_text,
                                'url' => $model_action_url,
                            ];
                        }
                    }
                } else {
                    $navigation['items'][] = [
                        'text' => $link_text,
                        'url' => $model_action_url
                    ];
                }
            }

            return $navigation;
        });

        return $adminBar_items->toArray();
    }

    public function registerSettings()
    {
        return [
            'femodeleditor' => [
                'label'       => 'romainmazb.femodeleditor::lang.plugin.name',
                'description' => 'romainmazb.femodeleditor::lang.plugin.description',
                'icon'        => 'icon-cubes',
                'url'         => Backend::url('romainmazb/femodeleditor/fememodels'),
                'category'    => SettingsManager::CATEGORY_CMS,
                'order'       => 500,
                'permissions' => ['romainmazb.femodeleditor.manage_feme']
            ]
        ];
    }
}
