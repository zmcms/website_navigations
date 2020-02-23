<?php
Route::middleware(['FrontendUser'])->group(function () {
	Route::get('{any}', function () {
	    return Request::path();	
	})->where('any', '.*');
});