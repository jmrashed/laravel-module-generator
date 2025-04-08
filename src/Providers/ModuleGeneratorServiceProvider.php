<?php

namespace Jmrashed\ModuleGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Jmrashed\ModuleGenerator\Commands\GenerateModuleCommand;
use Jmrashed\ModuleGenerator\Commands\PublishModuleGeneratorCommand;
use Jmrashed\ModuleGenerator\Contracts\ControllerGenerator;
use Jmrashed\ModuleGenerator\Contracts\ForeignKeyGenerator;
use Jmrashed\ModuleGenerator\Contracts\MigrationGenerator;
use Jmrashed\ModuleGenerator\Contracts\ModelGenerator;
use Jmrashed\ModuleGenerator\Contracts\ModuleGenerator;
use Jmrashed\ModuleGenerator\Contracts\RequestGenerator;
use Jmrashed\ModuleGenerator\Contracts\RouteGenerator;

class ModuleGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ModuleGenerator::class, function () {
            return new \Jmrashed\ModuleGenerator\Classes\Generators\ModuleGenerator();
        });
        $this->app->singleton(ModelGenerator::class, function ($module, $models) {
            return new \Jmrashed\ModuleGenerator\Classes\Generators\ModelGenerator($models[0] , $models[1]);
        });
        $this->app->singleton(MigrationGenerator::class, function ($module, $models) {
            return new \Jmrashed\ModuleGenerator\Classes\Generators\MigrationGenerator($models[0] , $models[1]);
        });
        $this->app->singleton(ControllerGenerator::class, function ($module, $models) {
            return new \Jmrashed\ModuleGenerator\Classes\Generators\ControllerGenerator($models[0] , $models[1]);
        });
        $this->app->singleton(RouteGenerator::class, function ($module, $models) {
            return new \Jmrashed\ModuleGenerator\Classes\Generators\RouteGenerator($models[0] , $models[1]);
        });
        $this->app->singleton(ForeignKeyGenerator::class, function ($module, $models) {
            return new \Jmrashed\ModuleGenerator\Classes\Generators\ForeignKeyGenerator($models[0] , $models[1]);
        });
        $this->app->singleton(RequestGenerator::class, function ($module, $models) {
            return new \Jmrashed\ModuleGenerator\Classes\Generators\RequestGenerator($models[0] , $models[1]);
        });
    }

    public function boot()
    {
        $this->commands([
            GenerateModuleCommand::class,
            PublishModuleGeneratorCommand::class
        ]);

        $this->publishes([
            __DIR__.'/../Config/generator.php' => config_path('generator.php'),
        ],'config');

    }
}
