<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\ActivityLogger;

class PivotActivityServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('activitylog.logger', function ($app) {
            return new ActivityLogger($app->make('config')->get('activitylog'));
        });

        $this->app->singleton('activitylog', function ($app) {
            $activityLogger = $app->make('activitylog.logger');
            $activityLogger->setLogName('pivot');

            return $activityLogger;
        });
    }
}