<?php

namespace App\Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResourceRegistrar;

class ModulesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $modules = config("module.Modules");
        if ($modules) {
            foreach ($modules as $module) {
                if (file_exists(__DIR__ . '/' . $module . '/Routes/routes.php')) {
                    $this->loadRoutesFrom(__DIR__ . '/' . $module . '/Routes/routes.php');
                }

                if (is_dir(__DIR__ . '/' . $module . '/Views')) {
                    $this->loadViewsFrom(__DIR__ . '/' . $module . '/Views', $module);
                }

                if (is_dir(__DIR__ . '/' . $module . '/Migrations')) {
                    $this->loadMigrationsFrom(__DIR__ . '/' . $module . '/Migrations');
                }

                if (is_dir(__DIR__ . '/' . $module . '/Lang')) {
                    $this->loadTranslationsFrom(__DIR__ . '/' . $module . '/Lang', $module);
                }

            }
        }
    }

    public function register()
    {

    }
}
