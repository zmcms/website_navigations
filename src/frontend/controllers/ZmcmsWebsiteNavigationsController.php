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
	public function navigations_tree($navigations, $parent = null){
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

	public function run($data){
		return 'xxxxxxxxxxxxx'.print_r($data, true);
	}
	/**
	 * METODA WYŚWIETLAJĄCA DLA STRONY STARTOWEJ
	 * $position - pozycja, z której wyświetlane są linki
	 * $q - ilość wyświetlanych rekorgów
	 */
	public function home($position, $q, $view){
		$resultset = ZMCMSDB::get_records($position, $active_only = false, $sort = [['sort', 'asc']], $q);
		return view($view, compact('resultset'));
		return $resultset;
	}
}