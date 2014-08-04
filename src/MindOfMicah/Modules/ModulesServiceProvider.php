<?php namespace MindOfMicah\Modules;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['modules.generate'] = $this->app->share(function ($app) {
            return $this->app->make('MindOfMicah\Modules\Commands\GenerateModuleCommand');
        });

        $this->commands('modules.generate');
	}
}
