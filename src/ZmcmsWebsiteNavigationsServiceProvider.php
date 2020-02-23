<?php
namespace Zmcms\WebsiteNavigations;
use Illuminate\Support\ServiceProvider;
class ZmcmsWebsiteNavigationsServiceProvider extends ServiceProvider{

	public function register(){
		$this->app->make('Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController');
		$this->app->make('Zmcms\WebsiteNavigations\Frontend\Controllers\ZmcmsWebsiteNavigationsController');
		require_once(__DIR__.'/helpers.php');
	}

	public function boot(){
		$this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'backend\routes'.DIRECTORY_SEPARATOR.'website_navigations.php');
		$this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'backend\routes'.DIRECTORY_SEPARATOR.'website_navigations_console.php');
		$this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'frontend\routes'.DIRECTORY_SEPARATOR.'website_navigations.php');
		$this->loadMigrationsFrom(__DIR__.'/migrations');
		$this->publishes([
			__DIR__.'/config' => base_path('config/'.Config('frontend.theme_name').'/zmcms/website_navigations'),
			__DIR__.'/backend/css' => base_path('public/themes/'.Config('frontend.theme_name').'/backend/css/'),
			__DIR__.'/backend/js' => base_path('public/themes/'.Config('frontend.theme_name').'/backend/js/'),
			__DIR__.'/backend/views' => base_path('resources/views/themes/'.Config('frontend.theme_name').'/backend'),
			__DIR__.'/frontend/css' => base_path('public/themes/'.Config('frontend.theme_name').'/frontend/css/'),
			__DIR__.'/frontend/js' => base_path('public/themes/'.Config('frontend.theme_name').'/frontend/js/'),
			__DIR__.'/frontend/views' => base_path('resources/views/themes/'.Config('frontend.theme_name').'/frontendwebsite_navigations'),
		]);
		View::addLocation(__DIR__.DIRECTORY_SEPARATOR.'/backend/views');
		View::addLocation(__DIR__.DIRECTORY_SEPARATOR.'/frontend/views');
	}

}
