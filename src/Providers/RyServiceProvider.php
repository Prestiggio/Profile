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
    	parent::boot();
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
    	
    	$use_trait = array_has(class_uses(User::class), "Ry\Profile\Models\Traits\Emailconfirmable");
    	if($use_trait) {
    		User::saved(function($user){
    			$confirmation = Emailconfirmation::where("email", "LIKE", $user->email)->first();
    			if(!$confirmation) {
    				Model::unguard();
    				 
    				$confirmation = $user->confirmation()->create([
    						"email" => $user->email,
    						"hash" => str_random(),
    						"valide" => false
    				]);
    				 
    				Model::reguard();
    				 
    				Mail::queue('ryprofile::emails.confirm', ["row" => $user, "confirmation" => $confirmation], function($message) use ($user){
    					$message->to($user->email, $user->name)->subject('Bienvenue sur aportax!');
    				});
    			}
    		});
    	}
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->register("Ry\Geo\Providers\RyServiceProvider");
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