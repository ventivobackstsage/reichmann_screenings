<?php

namespace App\Providers;

use App\Classes\SmartBillCloudRestClientClass;
use Illuminate\Support\ServiceProvider;

class SmartBillCloudRestClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('SmartBillCloudRestClientClass',function(){
        	return new SmartBillCloudRestClientClass();
        });
    }
}
