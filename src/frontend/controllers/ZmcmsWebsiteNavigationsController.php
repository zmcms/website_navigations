<?php
namespace Zmcms\WebsiteNavigations\Frontend\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Zmcms\WebsiteNavigations\Frontend\Model\WebsiteNavigationJoined as ZMCMSDB;
class ZmcmsWebsiteNavigationsController extends \App\Http\Controllers\Controller
{
	public function render($position = 'main', $paren = null){
		$arr =[];
		$data['resultset'] = $this->navigations_tree(ZMCMSDB::get_records($position, $active_only = true,  $sort = [['sort', 'asc']]), $parent = null);
		return view()->first([
			'themes.'.(Config('zmcms.frontend.theme_name') ?? 'zmcms').'.frontend.zmcms_nav_ul_list',
			'zmcms_nav_ul_list'
		], compact('data'));
	}
	/**
	 * Generuje drzewko nawigazji
	 */
	public function navigations_tree($navigations, $parent = null, $selected_token = null){
		$arr=[];
		foreach($navigations as $n){
			if($n->parent == $parent){
				$arr[$n->token]=[
					'token'				=> $n->token,
					'parent'			=> $n->parent,
					'position'			=> $n->position,
					'sort'				=> $n->sort,
					'access'			=> $n->access,
					'type'				=> $n->type,
					'active'			=> $n->active,
					'icon'				=> $n->icon,
					'ilustration'		=> $n->ilustration,
					'date_from'			=> $n->date_from,
					'date_to'			=> $n->date_to,
					'langs_id'			=> $n->langs_id,
					'link'				=> $n->link,
					'link_override'		=> $n->link_override,
					'name'				=> $n->name,
					'slug'				=> $n->slug,
					'meta_keywords'		=> $n->meta_keywords,
					'meta_description'	=> $n->meta_description,
					'og_title'			=> $n->og_title,
					'og_type'			=> $n->og_type,
					'og_url'			=> $n->og_url,
					'og_image'			=> $n->og_image,
					'og_description'	=> $n->og_description,
					'content'			=> $n->content,
				];
				if($this->is_parent($navigations, $n->token))
				$arr[$n->token]['children'] = $this->navigations_tree($navigations, $n->token);
			}
        }
        return $arr;
	}
	/**
	 * SPRAWDZA, czy dana pozycja w nawigacji ma coś do rozwinięcia
	 */
	private function is_parent($navigations, $token){
		$result=false;
		foreach($navigations as $n){
			if(($n->parent == $token)) $result = true;
		} 
		return  $result;
	}

	public function run($token_nav, $token_obj, $type, $opt){
		$str = '';
		$i=0;
		$data['navigation']['data'] = ZMCMSDB::get_navigation($token_obj, $langs_id = null);
		$data['navigation']['parents']= ZMCMSDB::get_parent_link($token_nav, $langs_id = null);
		$data['opt_runs'] = [];
		if(
			is_array(Config(Config('zmcms.frontend.theme_name').'.frontend.opt_runs')) && 
			Config(Config('zmcms.frontend.theme_name').'.frontend.opt_runs')!=[]
		)
		foreach(Config(Config('zmcms.frontend.theme_name').'.frontend.opt_runs') as $r){
			$data['opt_runs'][] = \App::call(
				$r,
				[	'obj_type'=>$type,
					'obj_token'=>$token_obj,
					'params'=> [$token_nav, $token_obj, $type],
				]
			);
		}
		
		// $str .= print_r(Config(Config('zmcms.frontend.theme_name').'.frontend.opt_runs'), true);
		$head = [
			'title' => $data['navigation']['data']->name.' - '.Config((Config('zmcms.frontend.theme_name') ?? 'zmcms').'.seosem.head.title'),
			'keywords' => $data['navigation']['data']->meta_keywords,
			'description' => $data['navigation']['data']->meta_description,
			'canonical' => $data['navigation']['data']->canonical ?? null,
			'og:title' => $data['navigation']['data']->og_title,
			'og:type' => $data['navigation']['data']->og_type,
			'og:url' => $data['navigation']['data']->og_url,
			'og:image' => $data['navigation']['data']->og_image,
			'og:description' => $data['navigation']['data']->og_description,
			'og:locale' => $data['navigation']['data']->langs_id,
			'language' => $data['navigation']['data']->langs_id,
		];
		return view('themes.'.Config('zmcms.frontend.theme_name').'.frontend.zmcms_website_'.$type, compact('data', 'head', 'str'));
	}
/**
 [og_title] => Hurtownia Horożaniecki - wszystko dla budownictwa
                    [og_type] => site
                    [og_url] => 
                    [og_image] => /themes/horbudcompl/media/steel-1700282_1920.jpg
                    [og_description] => Hurtownia Horożaniecki - wszystko dla budownictwa










 */

	/**
	 * METODA WYŚWIETLAJĄCA DLA STRONY STARTOWEJ
	 * $position - pozycja, z której wyświetlane są linki
	 * $q - ilość wyświetlanych rekorgów
	 */
	public function home($position, $q, $view){
		$resultset = ZMCMSDB::get_records($position, $active_only = false, $sort = [['sort', 'desc']], $q);
		return view($view, compact('resultset'));
		return $resultset;
	}

	public function run_static_page($token_nav, $token_obj, $type){
		$resultset=$data=[];
		// $data['navigation'] = ZMCMSDB::get_navigation($token_nav);
		$data['navigation']['data'] = ZMCMSDB::get_navigation($token_obj, $langs_id = null);
		$data['navigation']['parents']= ZMCMSDB::get_parent_link($token_nav, $langs_id = null);
		$head = [
			'title' => $data['navigation']['data']->name.' - '.Config((Config('zmcms.frontend.theme_name') ?? 'zmcms').'.contact_data.headquarters.business_name'),
			'keywords' => $data['navigation']['data']->meta_keywords,
			'description' => $data['navigation']['data']->meta_description,
			'canonical' => $data['navigation']['data']->canonical ?? null,
			'og:title' => $data['navigation']['data']->og_title,
			'og:type' => $data['navigation']['data']->og_type,
			'og:url' => $data['navigation']['data']->og_url,
			'og:image' => $data['navigation']['data']->og_image,
			'og:description' => $data['navigation']['data']->og_description,
			'og:locale' => $data['navigation']['data']->langs_id,
			'language' => $data['navigation']['data']->langs_id,
		];
		return view('themes.'.(Config('zmcms.frontend.theme_name') ?? 'zmcms').'.frontend.static_pages.'.$data['navigation']['data']->slug.'.page', compact('data', 'resultset', 'head'));
				return '<pre>
		token_nav: '.$token_nav.'
		token_obj: '.$token_obj.'
		type: '.$type.'
		'.print_r($data['navigation'], true).'</pre>';
	}

}
/**
 * {


 		"run":"\\Zmcms\\WebsiteArticles\\Frontend\\Controllers\\ZmcmsWebsiteArticlesController@run",
 		"token_nav":"893de94a6d52e611d50f693ae6f9a6293c41829595c68813693d00eb56edf8a8",
 		"token_obj":"0af0783af906a21e09900a2fb2f3892fdf76e2a256dab1e740b0e177c9b5ee05",
 		"view":"themes.milekcompl.frontend.static.pagename",
 		"type":"static_ppages"
 	}
 */