<?php
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;
Route::middleware(['FrontendUser'])->group(function () {
	/**
	 * WYSYŁKA FORMULARZY
	 */
	// if(Request::path() == '/frm_submit')
	Route::post('frm_submit', 'Zmcms\Main\Frontend\Controllers\ZmcmsMainController@frm_submit');
	
	Route::get('{any}', function () {
		/**
		 * GDY MAMY STRONĘ GŁÓWNĄ:
		 */
		if(Request::path() == '/')
			//Gdy jest strona główna
			return \App::call(
			'Zmcms\Main\Frontend\Controllers\ZmcmsMainController@homepage'
		);
			// return \App::call(
				// 'Zmcms\Main\Frontend\Controllers\ZmcmsMainController@frm_submit',
				// [
					// 'request'=>$request,
				// ]
			// );


		/**
		 * GDY NIE MAMY SRONY GŁÓWNEJ, SPRAWDZAM W TABELI ROUTINGU CZY JEST WPIS O DANYM LINKU
		 */
		$tblNamePrefix=(Config('database.prefix')??'');
		$route_table=$tblNamePrefix.'zmcms_routes_table';
		$resultset = DB::table($route_table)
			->where('path', '/'.Request::path())
			->first();
		if($resultset != null){
			$params=json_decode($resultset->parameters);
			// return print_r($params, true);
			return \App::call(
				$params->run,
				[
					'token_nav'=>$params->token_nav,
					'token_obj'=>$params->token_obj,
					'type'=>$params->type,
				]
			);
		}

			

			// return '<pre>xx'.print_r($resultset, true).'</pre>';
		/**
		 * GDY NIE MAMY SRONY GŁÓWNEJ, Nnie ma nic w tabeli routingu, 
		 * to może to jakaś kategoria?
		 */
		$tblNamePrefix=(Config('database.prefix')??'');
		$wnav=$tblNamePrefix.'website_navigations';
		$wnavnames=$tblNamePrefix.'website_navigations_names';
		$resultset = DB::table($wnavnames)
			->join($wnav, $wnav.'.token', '=', $wnavnames.'.token')
			->where($wnavnames.'.langs_id', Session::get('language'))
			->where($wnavnames.'.link', Request::path())
			->first();
		if($resultset!=null)
		return \App::call(
			Config(Config('zmcms.frontend.theme_name').'.website_navigations.'.$resultset->type.'.run'),
			['data' => $resultset]
		);
		/**
		 * GDY NIE ZNALEZIONO ODPOWIEDNIEJ NAWIGACJI, SKRYPT WYRZUCA INFO DO UŻYTKOWNIKA, ŻE NIE ZNALAZŁ
		 * MIEJSCA DOCELOWEGO
		 */
		return Request::path();	


		/**
		 * Zrobić: jeśli istnieje cache i jest młodszy niż jedna godzina pobież z cache.
		 * Jeżeli cache jest starszy, pobierz z bazy i zaktualizuj cache
		 * Jeżeli nie ma w cache, pobierz z bazy i utwórz cache
		 * W miarę możliwości cache'm powinien być GOTOWY HTML, który wystarczy wpiąć w widok.  
		 */


	    
	})->where('any', '.*');
});