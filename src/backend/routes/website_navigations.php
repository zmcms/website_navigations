<?php
$prefix = Config('zmcms.main.backend_prefix');
Route::middleware(['BackendUser'])->group(function () use($prefix){
	Route::get($prefix.'/website/navigations/zmcms_website_navigations_positions', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigations_positions')
		->name('website_navigations_positions');
	Route::get($prefix.'/zmcms_website_navigation_position_delete/{position}', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigation_position_delete')
		->name('website_navigations_positions');
	Route::get($prefix.'/zmcms_website_navigation_position_new_frm', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigation_position_new_frm')
		->name('website_navigations_positions');
	Route::post($prefix.'/zmcms_website_navigation_position_save',
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigation_position_save')
		->name('website_navigations_positions');
	Route::get($prefix.'/zmcms_website_navigation_positions_refresh', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigation_positions_refresh')
		->name('website_navigations_positions');
	Route::get($prefix.'/zmcms_website_navigation_position_edit_frm/{position}', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigation_position_edit_frm')
		->name('website_navigations_positions');
	Route::get($prefix.'/website/navigations/zmcms_website_navigations_types', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigations_types')
		->name('website_navigations_positions_types');
	Route::get($prefix.'/zmcms_website_navigation_type_new_frm', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigation_type_new_frm')
		->name('website_navigations_positions_types');
	Route::post($prefix.'/zmcms_website_navigation_type_save', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigation_type_save')
		->name('website_navigations_positions_types');
	Route::get($prefix.'/zmcms_website_navigation_type_delete/{type}', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigation_type_delete')
		->name('website_navigations_positions_types');
	Route::get($prefix.'/zmcms_website_navigation_type_update_frm/{type}', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsController@zmcms_website_navigation_type_update_frm')
		->name('website_navigations_positions_types');
	

	/**
	 * PANEL NAWIGACJI
	 */
	Route::get($prefix.'/website/navigations/zmcms_website_navigations_panel', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsPanelController@zmcms_website_navigations_panel')
		->name('website_navigations_manage');

	Route::get($prefix.'/zmcms_website_navigation_get_navigation/{position}', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsPanelController@zmcms_website_navigation_get_navigation')
		->name('website_navigations_manage');
	Route::get($prefix.'/website/navigations/create_link/{position}/{parent}', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsPanelController@website_navigations_create_link')
		->name('website_navigations_manage');
	Route::get($prefix.'/website/navigations/create_link/{position}', 
		'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsPanelController@website_navigations_create_link')
		->name('website_navigations_manage');
	Route::post($prefix.'/zmcms_website_navigations_create_link',
		 'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsPanelController@zmcms_website_navigations_create_link')
		->name('website_navigations_manage');
	Route::get($prefix.'/website/navigations/zmcms_website_navigations_edit/{token}',
		 'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsPanelController@zmcms_website_navigations_edit')
		->name('website_navigations_manage');
	Route::get($prefix.'/website/navigations/zmcms_website_navigations_delete/{token}',
		 'Zmcms\WebsiteNavigations\Backend\Controllers\ZmcmsWebsiteNavigationsPanelController@zmcms_website_navigations_delete')
		->name('website_navigations_manage');	
});
