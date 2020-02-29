<?php
namespace Zmcms\WebsiteNavigations;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades;

$website_navigations_positions = [
	['position'=>'main'],
	['position'=>'bottom'],
	['position'=>'start_page'],
	['position'=>'left'],
	['position'=>'right'],
];

$website_navigations_positions_names=[
	['position' => 'main',			'langs_id' => 'pl',	'name' => 'Główne', ],
	['position' => 'bottom',		'langs_id' => 'pl',	'name' => 'Stopka', ],
	['position' => 'start_page',	'langs_id' => 'pl',	'name' => 'Strona startowa', ],
	['position' => 'left',			'langs_id' => 'pl',	'name' => 'Lewa kolumna', ],
	['position' => 'right',			'langs_id' => 'pl',	'name' => 'Prawa kolumna', ],
];

$website_navigations = [
	['token' => '1', 	'parent' => null, 	'position' => 'main', 'sort' => 1, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
	['token' => '2', 	'parent' => null, 	'position' => 'main', 'sort' => 2, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
	['token' => '3', 	'parent' => null, 	'position' => 'main', 'sort' => 3, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
	['token' => '4', 	'parent' => null, 	'position' => 'main', 'sort' => 3, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
	['token' => '5', 	'parent' => null, 	'position' => 'main', 'sort' => 3, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
	['token' => '6', 	'parent' => '4', 	'position' => 'main', 'sort' => 3, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
	['token' => '7', 	'parent' => '6', 	'position' => 'main', 'sort' => 3, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
	['token' => '8', 	'parent' => null, 	'position' => 'main', 'sort' => 3, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
	['token' => '9', 	'parent' => '4', 	'position' => 'main', 'sort' => 3, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
	['token' => '10', 	'parent' => '8', 	'position' => 'main', 'sort' => 3, 'access' => '*', 'type' => 'static_pages', 'active' => '1', 'icon' => null, 'ilustration' => null, 'date_from' => date('Y-m-d'), 'date_to' => null, ],
];

$website_navigations_names = [
	['token' => '1', 	'langs_id'=>'pl', 'link'=>'o-nas',   	'name'=>'O nas',   'slug'=>'o-nas',   'meta_keywords'=>'l-bit.pl, informatyk', 			'meta_description'=>'Informacje o L-bit.pl', 								'og_title'=>'O nas', 	'og_type'=>'site', 'og_url'=>Config('app.url').'/o-nas', 	'og_image'=>null, 'og_description'=>'Informacje o L-bit.pl', ],
	['token' => '2', 	'langs_id'=>'pl', 'link'=>'oferta',  	'name'=>'Oferta',  'slug'=>'oferta',  'meta_keywords'=>'obsługa it, it, outsourcing', 	'meta_description'=>'Sprawdź naszą ofertę obsługi IT w Twojej firmie.', 	'og_title'=>'Oferta',	'og_type'=>'site', 'og_url'=>Config('app.url').'/oferta', 	'og_image'=>null, 'og_description'=>'Sprawdź naszą ofertę obsługi IT w Twojej firmie.', ],
	['token' => '3', 	'langs_id'=>'pl', 'link'=>'kontakt', 	'name'=>'Kontakt', 'slug'=>'kontakt', 'meta_keywords'=>'l-bit.pl, informatyk', 			'meta_description'=>'Możesz skontaktować się z nami na wiele sposobów!', 	'og_title'=>'Kontakt',	'og_type'=>'site', 'og_url'=>Config('app.url').'/kontakt', 	'og_image'=>null, 'og_description'=>'Możesz skontaktować się z nami na wiele sposobów!', ],
	['token' => '4', 	'langs_id'=>'pl', 'link'=>'mnu.1', 		'name'=>'Menu.1', 'slug'=>'kontakt', 'meta_keywords'=>'l-bit.pl, informatyk', 			'meta_description'=>'Możesz skontaktować się z nami na wiele sposobów!', 	'og_title'=>'Kontakt',	'og_type'=>'site', 'og_url'=>Config('app.url').'/kontakt', 	'og_image'=>null, 'og_description'=>'Możesz skontaktować się z nami na wiele sposobów!', ],
	['token' => '5', 	'langs_id'=>'pl', 'link'=>'mnu.2', 		'name'=>'Menu.2', 'slug'=>'kontakt', 'meta_keywords'=>'l-bit.pl, informatyk', 			'meta_description'=>'Możesz skontaktować się z nami na wiele sposobów!', 	'og_title'=>'Kontakt',	'og_type'=>'site', 'og_url'=>Config('app.url').'/kontakt', 	'og_image'=>null, 'og_description'=>'Możesz skontaktować się z nami na wiele sposobów!', ],
	['token' => '6', 	'langs_id'=>'pl', 'link'=>'mnu.1.1', 	'name'=>'Menu.1.1', 'slug'=>'kontakt', 'meta_keywords'=>'l-bit.pl, informatyk', 			'meta_description'=>'Możesz skontaktować się z nami na wiele sposobów!', 	'og_title'=>'Kontakt',	'og_type'=>'site', 'og_url'=>Config('app.url').'/kontakt', 	'og_image'=>null, 'og_description'=>'Możesz skontaktować się z nami na wiele sposobów!', ],
	['token' => '7', 	'langs_id'=>'pl', 'link'=>'mnu.1.1.1', 	'name'=>'Menu.1.1.1', 'slug'=>'kontakt', 'meta_keywords'=>'l-bit.pl, informatyk', 			'meta_description'=>'Możesz skontaktować się z nami na wiele sposobów!', 	'og_title'=>'Kontakt',	'og_type'=>'site', 'og_url'=>Config('app.url').'/kontakt', 	'og_image'=>null, 'og_description'=>'Możesz skontaktować się z nami na wiele sposobów!', ],
	['token' => '8', 	'langs_id'=>'pl', 'link'=>'mnu3', 		'name'=>'Menu3', 'slug'=>'kontakt', 'meta_keywords'=>'l-bit.pl, informatyk', 			'meta_description'=>'Możesz skontaktować się z nami na wiele sposobów!', 	'og_title'=>'Kontakt',	'og_type'=>'site', 'og_url'=>Config('app.url').'/kontakt', 	'og_image'=>null, 'og_description'=>'Możesz skontaktować się z nami na wiele sposobów!', ],
	['token' => '9', 	'langs_id'=>'pl', 'link'=>'mnu.1.2', 	'name'=>'Menu.1.2', 'slug'=>'kontakt', 'meta_keywords'=>'l-bit.pl, informatyk', 			'meta_description'=>'Możesz skontaktować się z nami na wiele sposobów!', 	'og_title'=>'Kontakt',	'og_type'=>'site', 'og_url'=>Config('app.url').'/kontakt', 	'og_image'=>null, 'og_description'=>'Możesz skontaktować się z nami na wiele sposobów!', ],
	['token' => '10', 	'langs_id'=>'pl', 'link'=>'mnu.8.1', 	'name'=>'Menu.8.1', 'slug'=>'kontakt', 'meta_keywords'=>'l-bit.pl, informatyk', 			'meta_description'=>'Możesz skontaktować się z nami na wiele sposobów!', 	'og_title'=>'Kontakt',	'og_type'=>'site', 'og_url'=>Config('app.url').'/kontakt', 	'og_image'=>null, 'og_description'=>'Możesz skontaktować się z nami na wiele sposobów!', ],
];

$tblNamePrefix=(Config('database.prefix')??'');
$tblName=$tblNamePrefix.'website_navigations_positions';
foreach($website_navigations_positions as $a){
	DB::table($tblName)->insert(['position'=>$a['position'], ]);
}

$tblName=$tblNamePrefix.'website_navigations_positions_names';
foreach($website_navigations_positions_names as $a){
	DB::table($tblName)->insert([
		'position' 	=> 	$a['position'],
		'langs_id' 	=> 	$a['langs_id'],
		'name' 		=> 	$a['name'],
	]);
}

$tblName=$tblNamePrefix.'website_navigations';
foreach($website_navigations as $a){
	DB::table($tblName)->insert([
		'token' 		=> 	$a['token'],
		'parent' 		=> 	$a['parent'],
		'position' 		=> 	$a['position'],
		'sort' 			=> 	$a['sort'],
		'access' 		=> 	$a['access'],
		'type' 			=> 	$a['type'],
		'active' 		=> 	$a['active'],
		'icon' 			=> 	$a['icon'],
		'ilustration' 	=> 	$a['ilustration'],
		'date_from' 	=> 	$a['date_from'],
		'date_to' 		=> 	$a['date_to'],
	]);
}

$tblName=$tblNamePrefix.'website_navigations_names';
foreach($website_navigations_names as $a){
	DB::table($tblName)->insert([
		'token'				=> $a['token'],
		'langs_id'			=> $a['langs_id'],
		'link'				=> $a['link'],
		'name'				=> $a['name'],
		'slug'				=> $a['slug'],
		'meta_keywords'		=> $a['meta_keywords'],
		'meta_description'	=> $a['meta_description'],
		'og_title'			=> $a['og_title'],
		'og_type'			=> $a['og_type'],
		'og_url'			=> $a['og_url'],
		'og_image'			=> $a['og_image'],
		'og_description'	=> $a['og_description'],
	]);
}

$tblName=$tblNamePrefix.'website_navigations_content';



