<?php
use Illuminate\Support\Facades\DB;
Route::middleware(['FrontendUser'])->group(function () {
	Route::get('{any}', function () {
		/**
		 * GDY MAMY STRONĘ GŁÓWNĄ:
		 */
		if(Request::path() == '/')
			//Gdy jest strona główna
			return \App::call(
			'Zmcms\Main\Frontend\Controllers\ZmcmsMainController@homepage'
		);
		/**
		 * GDY NIE MAMY SRONY GŁÓWNEJ, SPRAWDZAM RODZAJ KLIKNIĘTEJ NAWIGACJI
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