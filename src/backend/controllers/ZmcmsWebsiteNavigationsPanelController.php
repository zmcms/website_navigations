<?php
namespace Zmcms\WebsiteNavigations\Backend\Controllers;
use Illuminate\Http\Request;
use Session;
use \Zmcms\WebsiteNavigations\Backend\Db\Queries as Q;
use \Zmcms\WebsiteNavigations\Frontend\Model\WebsiteNavigationJoined as ZMCMSDB;
use Intervention\Image\ImageManagerStatic as Image;
class ZmcmsWebsiteNavigationsPanelController extends \App\Http\Controllers\Controller
{
	/**
	 * OTWIERA PANEL DO ZARZĄDZANIA NAWIGACJĄ
	 */
	public function zmcms_website_navigations_panel(){
		$data['positions'] = Q::navigation_positions_list(0, $order=[], $filter=[]);
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_panel', compact('data'));
	}

	public function zmcms_website_navigation_get_navigation($position){
		$data['resultset'] = (new \Zmcms\WebsiteNavigations\Frontend\Controllers\ZmcmsWebsiteNavigationsController())->navigations_tree(ZMCMSDB::get_records($position, $active_only = false, [['sort', 'asc']]), $parent = null);
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_nav_ul_list', compact('data'));
	}

	public function website_navigations_create_link($position, $parent=null){
		// return $parent;
		$data['positions'] = Q::navigation_positions_list(0, $order=[], $filter=[]);
		// return '<pre>'.print_r($data['positions'], true).'</pre>';
		$data['position'] = $position;
		$data['parent'] = $parent;
		// return $parent;
		$data['tree'] =  (new \Zmcms\WebsiteNavigations\Frontend\Controllers\ZmcmsWebsiteNavigationsController())->navigations_tree(ZMCMSDB::get_records($position, $active_only = false, [['sort', 'asc']]), $parent = null);
		$data['parentdata'] = ZMCMSDB::get_parent_link($data['parent']);
		$settings=[
			'position' => $position,
			'action' => 'create',
			'btnsave' => 'Zapisz zmiany',
		];
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_create_link_frm', compact('data', 'settings'));
	}
	public function zmcms_website_navigations_create_link(Request $request){
		if($request->all()['action'] == 'update'){
			return $this->zmcms_website_navigations_update_link($request);
		}
		$data = $request->all();
		//IKONY
		$d['icon'] = 
			(strlen($data['icon'])>0)
			?base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$data['icon']
			:null;
		if($d['icon']!=null)	
		$res['icon'] = zmcms_image_save(
				$d['icon'],
				base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.Config('zmcms.frontend.theme_name').DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'store'.DIRECTORY_SEPARATOR.'nav'.DIRECTORY_SEPARATOR.'icons',
				str_slug($data['name']).'.jpg');
		// ILUSTRACJE
		$d['ilustration'] = 
			(strlen($data['ilustration'])>0)
			?base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$data['ilustration']
			:null;
		if($d['ilustration']!=null)	
		$res['ilustration'] = zmcms_image_save(
				$d['ilustration'],
				base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.Config('zmcms.frontend.theme_name').DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'store'.DIRECTORY_SEPARATOR.'nav'.DIRECTORY_SEPARATOR.'ilustrations',
				str_slug($data['name']).'.jpg');
		// ILUSTRACJA OG
		$d['og_image'] = 
			(strlen($data['og_image'])>0)
			?base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$data['og_image']
			:null;
		if($d['og_image']!=null)	
		$res['og_image'] = zmcms_image_save(
				$d['og_image'],
				base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.Config('zmcms.frontend.theme_name').DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'store'.DIRECTORY_SEPARATOR.'nav'.DIRECTORY_SEPARATOR.'og',
				str_slug($data['name']).'.jpg');
		if(isset($res))
			$data['images_resized'] = json_encode($res); // ZESTAW ŚCIEŻEK DO SKODOWANYCH ILUSTRACJI, IKON ITD Z PODZIAŁEM NA SZEROKOŚCI
		else
			$data['images_resized']=null;
		$result = Q::zmcms_website_navigation_create($data);
		// Gdy utworzyłem obiekt publikuję do niego link w tabeli routingów
		if($result['result']=='ok'){
			$params = [
				'run'=>Config(Config('zmcms.frontend.theme_name').'.website_navigations.'.$data['type'].'.run'),
				'token_nav'=>$result['objtoken'],//Token nawigacji
				'token_obj'=>$result['objtoken'],//Token przypinanego obiektu. Jeżeli obiektem jest sama nawigacja, to token może być ten sam
				'type'=>$data['type'],//Rodzaj przypinanego obiektu
			];
			Q::create_route(
				$path = ((strlen($data['link_override'])>0)?$data['link_override']:$data['link']), 
				$parameters = json_encode($params)
			);
		}
		return json_encode($result);
	}
	public function zmcms_website_navigations_update_link(Request $request){
		$data = $request->all();
		// return print_r($request->all(), true);
		$res = [];
		//IKONY
		$d['icon'] = 
			(strlen($data['icon'])>0)
			?str_replace(['\\', '/'], DIRECTORY_SEPARATOR, base_path().DIRECTORY_SEPARATOR.'public'.$data['icon'])
			:null;
			// return $d['icon'];
		if($d['icon']!=null)	
		$res['icon'] = zmcms_image_save(
				$d['icon'],
				base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.Config('zmcms.frontend.theme_name').DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'store'.DIRECTORY_SEPARATOR.'nav'.DIRECTORY_SEPARATOR.'icons',
				str_slug($data['name']).'.jpg');
		// ILUSTRACJE
		$d['ilustration'] = 
			(strlen($data['ilustration'])>0)
			?str_replace(['\\', '/'], DIRECTORY_SEPARATOR, base_path().DIRECTORY_SEPARATOR.'public'.$data['ilustration'])
			:null;
		if($d['ilustration']!=null)	
		$res['ilustration'] = zmcms_image_save(
				$d['ilustration'],
				base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.Config('zmcms.frontend.theme_name').DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'store'.DIRECTORY_SEPARATOR.'nav'.DIRECTORY_SEPARATOR.'ilustrations',
				str_slug($data['name']).'.jpg');
		// ILUSTRACJA OG
		$d['og_image'] = 
			(strlen($data['og_image'])>0)
			?str_replace(['\\', '/'], DIRECTORY_SEPARATOR, base_path().DIRECTORY_SEPARATOR.'public'.$data['og_image'])
			:null;
		if($d['og_image']!=null)	
		$res['og_image'] = zmcms_image_save(
				$d['og_image'],
				base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.Config('zmcms.frontend.theme_name').DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'store'.DIRECTORY_SEPARATOR.'nav'.DIRECTORY_SEPARATOR.'og',
				str_slug($data['name']).'.jpg');
		$data['images_resized'] = json_encode($res); // ZESTAW ŚCIEŻEK DO SKODOWANYCH ILUSTRACJI, IKON ITD Z PODZIAŁEM NA SZEROKOŚCI
		$result = Q::zmcms_website_navigation_update($data);
		$result['content']=$res;

		if($result['result']=='ok'){
			$params = [
				'run'=>Config(Config('zmcms.frontend.theme_name').'.website_navigations.'.$data['type'].'.run'),
				'token_nav'=>$data['token'],//Token nawigacji
				'token_obj'=>$data['token'],//Token przypinanego obiektu. Jeżeli obiektem jest sama nawigacja, to token może być ten sam
				'type'=>$data['type'],//Rodzaj przypinanego obiektu
			];
			if((strlen($data['link_override_old'])==0) && strlen($data['link_override'])>0){
				Q::replace_route(addslashes($data['link_old']) , addslashes($data['link_override']) , json_encode($params));
			}
			if((strlen($data['link_override_old'])==0) && strlen($data['link_override'])==0){
				Q::replace_route(addslashes($data['link_old']) , addslashes($data['link']) , json_encode($params));
			}
			if((strlen($data['link_override_old'])>0) && strlen($data['link_override'])==0){
				Q::replace_route(addslashes($data['link_override_old']) , addslashes($data['link']) , json_encode($params));
			}
			if((strlen($data['link_override_old'])>0) && strlen($data['link_override'])>0){
				Q::replace_route(addslashes($data['link_override_old']) , addslashes($data['link_override']) , json_encode($params));
			}
		}

		return json_encode($result);	
	}
	public function zmcms_website_navigations_edit($token){
		$wnav = (Config('database.prefix')??'').'website_navigations';
		$data = (Q::get_navigation_object($token))['data'][0];
		$settings=[
			'action' => 'update',
			'btnsave' => 'Zapisz zmiany',
		];
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_create_link_frm', compact('data', 'settings'));
	}
	public function zmcms_website_navigations_delete($token = null){
		if($token == null) return json_encode([
			'result'	=>	'err',
			'code'		=>	'notoken',
			'msg' 		=>	___('Nie można usunąć linku - nie podano tokena.'),
			// 'token'		=>$token,
		]);
		Q::delete_route_by_params($token);
		return Q::delete_navigation_object($token);
		return $token;
	}
	public function zmcms_website_navigations_get_parent_link($token = null){
		if($token == null) return null;
		return ZMCMSDB::get_link($token);
	}

	/**
	 * LINKUJE OBIEKTY POD DANĄ POZYCJĘ NAWIGACJI
	 */
	public function zmcms_website_navigations_linker_frm($token, $type, $slug = null){
		// DRZEWO NAWIGACJI
		$res = (new \Zmcms\WebsiteNavigations\Frontend\Controllers\ZmcmsWebsiteNavigationsController())->navigations_tree(ZMCMSDB::get_records($position = null, $active_only = false, $sort = [['sort', 'asc']], $q = null, $langs_id = null));
		$data = $settings = []; foreach ($res as $r) {$data[$r['position']][] = $r; }
		// TABLICA POZYCJI
		$pos = Q::navigation_positions_list($paginate = 0, $order=[], $filter=[]);
		$positions = [];
		foreach($pos as $p =>$v)
			$positions[$v->position] = $v->name;
		$linked = Q::linker_links_for_object($token, $type);
		$linked_object = [
			'token'	=>$token,
			'type'	=>$type,
			'slug'  =>$slug,
		];
		return view(
			'themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_linker', 
			compact('data', 'positions', 'linked', 'linked_object')
		);
	}
	/**
	 * PRZYPINA LUB ODPOINA OBIEKT OD LINKU Z NAWIGACJI
	 */
	public function zmcms_website_navigations_linker_toggle($navtoken, $navslug, $linkedobjtoken, $linkedobjtype, $linkedobjslug = null){
		Q::zmcms_website_navigations_linker_toggle($navtoken, $linkedobjtoken, $linkedobjtype);
		$params = [];
		$params = [
			'run'=>Config(Config('zmcms.frontend.theme_name').'.website_navigations.'.$linkedobjtype.'.run'),
			'token_nav'=>$navtoken,
			'token_obj'=>$linkedobjtoken,
			'type'=>$linkedobjtype,
		];
		$link = '';
		$nav_obj = Q::get_navigation_object($navtoken)['data'][0];
		(
			strlen($nav_obj->link_override)>0
		)? 
		$link = $nav_obj->link_override
		: 
		$link = $nav_obj->link;
		if($linkedobjslug!=null)$link = $link.'/'.$linkedobjslug;
		// return $link;
		Q::create_route($path = $link, $parameters = json_encode($params));
	}
}