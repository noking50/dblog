<?php

namespace Noking50\DBLog;

use Illuminate\Support\ServiceProvider;

class DBLogServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot() {
        $this->publishes([
            __DIR__ . '/../config/dblog.php' => config_path('dblog.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('dblog', function () {
            return new DBLog;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['dblog'];
    }

}
