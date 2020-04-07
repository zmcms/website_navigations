<?php
/**
 * Przypisujemy kontrolery oraz metody kontrolerów dla poszczególnych rodzajów linków w nawigacji.
 * Format: Kontroler@metoda
 * Tablica jest otwarta - można dodawać kolejne rodzaje linków z nawigacji stosując maskę:
 * 'rodzaj-obiektu'=>[
 *  'single'=>'Kontroler@metoda',
 *  'list'=>'Kontroler@metoda',
 *  'name'=>[
 *    'pl'=>'NAzwa rodzaju w języku polskiim'
 *  ]
 * ]
 * 
 */
return [
  'self'=>[
    'single'=>'Zmcms\WebsiteNavigations\Controllers\Frontend\ZmcmsWebsiteNavigationsController@single',
    'list'=>'Zmcms\WebsiteNavigations\Controllers\Frontend\ZmcmsWebsiteNavigationsController@list',
    'name'=>'Samodzielny',
    'description'=>'',
  ],
  'static_pages'=>[
    'single'=>'',
    'list'=>'',
    'name'=>'Strony statyczne',
    'description'=>'',
  ],
  'articles'=>[
    'single'=>'',
    'list'=>'',
    'name'=>'Artykuły',
    'description'=>'',
  ],
  'products'=>[
    'single'=>'',
    'list'=>'',
    'name'=>'Produkty',
    'description'=>'',
  ],
  'galleries'=>[
    'single'=>'',
    'list'=>'',
    'name'=>'Galerie',
    'description'=>'',
  ],
  /**
   * Kategoria (nawigacja) typu mixed pozwala podłączyć dowolny obiekt. 
   * Najbardziej elastyczna, jednak z uwagi na różnowodność obiektów może być 
   * najwolniejsza w działaniu przy większej ilości wyświetlanych obiektów.
   */
  'homepage'=>[
    'single'=>'',
    'list'=>'',
    'name'=>'Strona główna',
    'description'=>'',
  ],
];