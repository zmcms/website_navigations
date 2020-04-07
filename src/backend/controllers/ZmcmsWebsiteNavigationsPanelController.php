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
		$data['positions'] = Q::navigation_positions_list(0, $order=[], $filter=[]);
		$data['position'] = $position;
		$data['parent'] = $parent;
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
		$data['images_resized'] = json_encode($res); // ZESTAW ŚCIEŻEK DO SKODOWANYCH ILUSTRACJI, IKON ITD Z PODZIAŁEM NA SZEROKOŚCI
		$result = Q::zmcms_website_navigation_create($data);
		return json_encode($result);
	}
	public function zmcms_website_navigations_update_link(Request $request){
		$data = $request->all();
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
		]);
		return Q::delete_navigation_object($token);
		return $token;
	}
}
