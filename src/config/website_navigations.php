<?php
/**
 * Przypisujemy kontrolery oraz metody kontrolerów dla poszczególnych rodzajów linków w nawigacji.
 * Format: Kontroler@metoda
 * Tablica jest otwarta - można dodawać kolejne rodzaje linków z nawigacji stosując maskę:
 * 'rodzaj-obiektu'=>[
 * 	'single'=>'Kontroler@metoda',
 *  'list'=>'Kontroler@metoda',
 *  'names'=>[
 * 		'pl'=>'NAzwa rodzaju w języku polskiim'
 * 	]
 * ]
 * 
 */
return [
	'self'=>[
		'run' => '\\Zmcms\\WebsiteNavigations\\Frontend\\Controllers\\ZmcmsWebsiteNavigationsController@run',
    	'name' => 'Samodzielny',
    	'description' => 'Link jest samodzielnym obiektem. Od razu wyświetla własną treść po kliknięciu',
	],
	'static_page'=>[
    	'run' => 'ZmCms\\sd@run',
    	'name' => 'Strona statyczna',
    	'description' => 'Uruchamia stronę statyczną',
	],
];