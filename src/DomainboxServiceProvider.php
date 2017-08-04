<?php

namespace MadeITBelgium\Domainbox;

use Illuminate\Support\ServiceProvider;

/**
 * Domainbox API.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class DomainboxServiceProvider extends ServiceProvider
{
    protected $defer = false;

	protected $rules = [
        'domainname',
        'domainavailable'
	];
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/domainbox.php' => config_path('domainbox.php'),
        ]);
        
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'domainbox');
        $this->addNewRules();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('domainbox', function ($app) {
            $config = $app->make('config')->get('domainbox');

            return new Domainbox($config['reseller'], $config['username'], $config['password'], $config['sandbox']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['domainbox'];
    }
    
    protected function addNewRules()
    {
        foreach ($this->rules as $rule)
        {
            $this->extendValidator($rule);
        }
    }
    
    protected function extendValidator($rule)
    {
        $method = 'validate' . studly_case($rule);
        $translation = $this->app['translator']->get('domainbox::validation');
        $this->app['validator']->extend($rule, 'MadeITBelgium\Domainbox\Validation\ValidatorExtensions@' . $method, $translation[$rule]);
    }
}
