<?php

namespace App\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    protected $files;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $modules = $this->files->directories(app_path() . '/LaravelRestCms/Modules');

        foreach ($modules as $module)  {
            
            $route = $module . '/routes.php';

            if ($this->files->exists($route)) {
                require $route;
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->files = new Filesystem;
    }
}
