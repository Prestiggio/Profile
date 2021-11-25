<?php

namespace Ry\Profile\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App\User;
use Ry\Profile\Models\Emailconfirmation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class RyServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    	/*
    	$this->publishes([    			
    			__DIR__.'/../config/ryprofile.php' => config_path('ryprofile.php')
    	], "config");  
    	$this->mergeConfigFrom(
	        	__DIR__.'/../config/ryprofile.php', 'ryprofile'
	    );
    	$this->publishes([
    			__DIR__.'/../assets' => public_path('vendor/ryprofile'),
    	], "public");    	
    	*/
    	//ressources
    	$this->loadViewsFrom(__DIR__.'/../ressources/views', 'ryprofile');
    	$this->loadTranslationsFrom(__DIR__.'/../ressources/lang', 'ryprofile');
    	/*
    	$this->publishes([
    			__DIR__.'/../ressources/views' => resource_path('views/vendor/ryprofile'),
    			__DIR__.'/../ressources/lang' => resource_path('lang/vendor/ryprofile'),
    	], "ressources");
    	*/
    	$this->publishes([
    			__DIR__.'/../database/factories/' => database_path('factories'),
	        	__DIR__.'/../database/migrations/' => database_path('migrations')
	    ], 'migrations');
    	$this->map();
    	//$kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
    	//$kernel->pushMiddleware('Ry\Facebook\Http\Middleware\Facebook');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->register("Ry\Geo\Providers\RyServiceProvider");
    	$this->app->register("Ry\Medias\Providers\RyServiceProvider");
    }
    public function map()
    {    	
    	if (! $this->app->routesAreCached()) {
    		$this->app['router']->group(['namespace' => 'Ry\Profile\Http\Controllers'], function(){
    			require __DIR__.'/../Http/routes.php';
    		});
    	}
    }
}