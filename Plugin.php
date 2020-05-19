<?php

namespace RomainMazB\FEModelEditor;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'RomainMazB\FEModelEditor\Components\TopBar' => 'FEMETopBar'
        ];
    }
}
