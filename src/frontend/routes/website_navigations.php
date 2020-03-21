<?php
use Illuminate\Support\Facades\DB;
Route::middleware(['FrontendUser'])->group(function () {
	Route::get('{any}', function () {
		$tblNamePrefix=(Config('database.prefix')??'');
		$tblName=$tblNamePrefix.'website_navigations';
		$tblName=$tblNamePrefix.'website_navigations_names';
		/**
		 * Zrobić: jeśli istnieje cache i jest młodszy niż jedna godzina pobież z cache.
		 * Jeżeli cache jest starszy, pobierz z bazy i zaktualizuj cache
		 * Jeżeli nie ma w cache, pobierz z bazy i utwórz cache
		 * W miarę możliwości cache'm powinien być GOTOWY HTML, który wystarczy wpiąć w widok.  
		 */
	    return Request::path();	
	})->where('any', '.*');
});