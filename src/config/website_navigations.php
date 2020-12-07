<?php
/**
* Ten plik został utworzony automatycznie.
* Jeżeli wiesz, co robisz, możesz edytować samodzielnie ten plik, 
* jednak zalecamy mocno użycie formularza do aktualizacji tych danych w systemie
* Odpowiednie opcje znajdziesz w sekcji "Nawigacja"
**/

return array (
  'self' => 
  array (
    'run' => '\\Zmcms\\WebsiteNavigations\\Frontend\\Controllers\\ZmcmsWebsiteNavigationsController@run',
    'name' => 'Samodzielny',
    'description' => 'Link jest samodzielnym obiektem. Od razu wyświetla własną treść po kliknięciu',
  ),
  'articles' => array(
    'run' => '\\Zmcms\\WebsiteArticles\\Frontend\\Controllers\\ZmcmsWebsiteArticlesController@run',
    'name' => 'Artykuły',
    'description' => 'Link prowadzi do obiektów typu artykuł. Wyświetla docelowy artykuł w całości lub listę artykułów z domyślną pagnacją',
  ),
  'static_page' => 
  array (
    'run' => 'ZmCms\\sd@run',
    'name' => 'Strona statyczna',
    'description' => 'Uruchamia stronę statyczną',
  ),
);