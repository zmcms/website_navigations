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
		'single'=>'Zmcms\WebsiteNavigations\Controllers\Frontend\ZmcmsWebsiteNavigationsController@single',
		'list'=>'Zmcms\WebsiteNavigations\Controllers\Frontend\ZmcmsWebsiteNavigationsController@list',
		'names'=>[
			'pl'=>'Samodzielny',
			'en'=>'Independent',
		],
	],
	'static_pages'=>[
		'single'=>'',
		'list'=>'',
		'names'=>[
			'pl'=>'Strony statyczne',
			'en'=>'Static pages',
		],
	],
	'articles'=>[
		'single'=>'',
		'list'=>'',
		'names'=>[
			'pl'=>'Artykuły',
			'en'=>'Articles',
		],
	],
	'products'=>[
		'single'=>'',
		'list'=>'',
		'names'=>[
			'pl'=>'Produkty',
			'en'=>'Products',
		],
	],
	'galleries'=>[
		'single'=>'',
		'list'=>'',
		'names'=>[
			'pl'=>'Galerie',
			'en'=>'Galleries',
		],
	],
	/**
	 * Kategoria (nawigacja) typu mixed pozwala podłączyć dowolny obiekt. Najbardziej elastyczna, jednak z uwagi na różnowodność obiektów może być najwolniejsza w działaniu przy 
	 * większej ilości wyświetlanych obiektów.
	 */
	'mixed'=>[
		'single'=>'Miks',
		'list'=>'Mixed',	
	],
];