<?php
namespace Zmcms\WebsiteNavigations\Backend\Db;
use Illuminate\Support\Facades\DB;
use Session;
use Request;
class Queries{
	/**
	 * LISTA POZYCJI NAWIGACJI W SERWISIE
	 * Formaty zmiannych:
	 * 	$paginate (stronicowanie): 
	 *		if==0, wyświetla wszystko, 
	 * 		if==X: wyświetla wynik podzielony na strony, X elementów każda
	 * 	$order (sortowanie), tablica o poniższym formacie: 
	 * 		['sort' => 'asc', 'name' => 'desc']
	 * 	$filter (filtrowanie wyników)
	 * 		[
	 *			['langs_id', 	'=',		'pl'	],
	 *			['name', 		'rlike',	'główne'],
	 *		]
	 */
	public static function navigation_positions_list($paginate = 0, $order=[], $filter=[]){
		$pos = (Config('database.prefix')??'').'website_navigations_positions';
		$pos_names = (Config('database.prefix')??'').'website_navigations_positions_names';
		$resultset = DB::table($pos)
			->join($pos_names, $pos.'.position', '=', $pos_names.'.position');
		if($filter!=[])
			foreach($filter as $v) {
				$resultset->where($v[0], $v[1], $v[2]);
			}
			$resultset->select([
				$pos.'.position as position',
				$pos.'.sort as sort',
				$pos_names.'.langs_id as langs_id',
				$pos_names.'.name as name',
			]);
		if($order!=[])
			foreach ($order as $column => $direction) {
				$resultset->orderBy($column, $direction);
			}
		if($paginate==0)
			return $resultset->get();

		return $resultset->paginate($paginate);
	}

	/**
	 * USUWA POZYCJĘ Z BAZY DANYCH
	 */
	public static function zmcms_website_navigation_position_delete($position){
		$pos = (Config('database.prefix')??'').'website_navigations_positions';
		try{
			DB::beginTransaction();
				$resultset = DB::table($pos)
					->where('position', $position)
					->delete();
			DB::commit();
			return json_encode([
				'result'	=>	'ok',
				'code'		=>	'ok',
				'msg' 		=>	___('Pozycja nawigacji została usunięta'),
			]);
		}catch(\Illuminate\Database\QueryException $e){
			DB::rollBack();
			return json_encode([
				'result'	=>	'error',
				'code'		=>	$e->getCode(),
				'msg' 		=>	___('Nie można usunąć pozycji naigacji'),
			]);
					
		}
	}

	public static function zmcms_website_navigation_position_save($data){
		if($data['action'] == 'update') return self::zmcms_website_navigation_position_update($data);
		$pos = (Config('database.prefix')??'').'website_navigations_positions';
		$pos_names = (Config('database.prefix')??'').'website_navigations_positions_names';
		$count = DB::table($pos)->count();
		try{
			DB::beginTransaction();
				DB::table($pos)->insert([
					'position'=>$data['position'],
					'sort'=> $count,
				]);
				DB::table($pos_names)->insert([
					'position'=>$data['position'],
					'langs_id'=>($data['langs_id'] ?? Config(Config('zmcms.frontend.theme_name').'.main.lang_default')),
					'name'=> $data['name'],
				]);
			DB::commit();
			return ([
				'result'	=>	'ok',
				'code'		=>	'ok',
				'msg' 		=>	___('Dodano nową pozycję nawigacji'),
			]);
		}catch(\Illuminate\Database\QueryException $e){
			DB::rollBack();
			return ([
				'result'	=>	'error',
				'code'		=>	$e->getCode(),
				'msg' 		=>	___('Nie można dodać nowej pozycji naigacji'),
			]);
					
		}

	}

	public static function zmcms_website_navigation_position_update($data){
		$pos = (Config('database.prefix')??'').'website_navigations_positions';
		$pos_names = (Config('database.prefix')??'').'website_navigations_positions_names';
		$count = DB::table($pos)->count();
		try{
			DB::beginTransaction();
				DB::table($pos)
					->where('position', $data['position_old'])->update([
					'position'=>$data['position'],
					'sort'=> $count,
				]);
				DB::table($pos_names)
					->where('position', $data['position_old'])->update([
					'position'=>$data['position'],
					'langs_id'=>($data['langs_id'] ?? Config(Config('zmcms.frontend.theme_name').'.main.lang_default')),
					'name'=> $data['name'],
				]);
			DB::commit();
			return ([
				'result'	=>	'ok',
				'code'		=>	'ok',
				'msg' 		=>	___('Zaktualizowano pozycję nawigacji'),
			]);
		}catch(\Illuminate\Database\QueryException $e){
			DB::rollBack();
			return ([
				'result'	=>	'error',
				'code'		=>	$e->getCode().$e->getMessage(),
				'msg' 		=>	___('Nie zaktualizowano pozycji naigacji'),
			]);
					
		}
	}

	public static function zmcms_website_navigation_create($data){
		$wnav = (Config('database.prefix')??'').'website_navigations';
		$wnav_names = (Config('database.prefix')??'').'website_navigations_names';
		$wnav_content = (Config('database.prefix')??'').'website_navigations_content';

		if(strlen($data['token'])==0)$data['token']= hash ( 'sha256' , date('Ymd').rand(0,1000));
		try{
			DB::beginTransaction();
				DB::table($wnav)->insert([
					'token'			=> $data['token'],
					'parent'		=> $data['parent'],
					'position'		=> $data['position'],
					'sort'			=> $data['sort'],
					'access'		=> $data['access'],
					'type'			=> $data['type'],
					'active'		=> $data['active'],
					'icon'			=> $data['icon'],
					'ilustration'	=> $data['ilustration'],
					'images_resized'	=> $data['images_resized'],
					'date_from'		=> $data['date_from'],
					'date_to'		=> $data['date_to'],
				]);
				DB::table($wnav_names)->insert([
					'token'				=>$data['token'],
					'langs_id'			=>($data['langs_id'] ?? Config(Config('zmcms.frontend.theme_name').'.main.lang_default')),
					'link'				=>$data['link'],
					'link_override'		=>$data['link_override'],
					'name'				=>$data['name'],
					'slug'				=>$data['slug'],
					'meta_keywords'		=>$data['meta_keywords'],
					'meta_description'	=>$data['meta_description'],
					'og_title'			=>$data['og_title'],
					'og_type'			=>$data['og_type'],
					'og_url'			=>$data['og_url'],
					'og_image'			=>$data['og_image'],
					'og_description'	=>$data['og_description'],
				]);
			if(strlen($data['content'])!=0){
				DB::table($wnav_content)->insert([
						'token'		=>$data['token'],
						'langs_id'	=>($data['langs_id'] ?? Config(Config('zmcms.frontend.theme_name').'.main.lang_default')),
						'content'	=>$data['content'],
					]);
			};
			DB::commit();
			return ([
				'result'	=>	'ok',
				'code'		=>	'ok',
				'msg' 		=>	___('Dodano nowy obiekt nawigacji'),
				'objtoken'	=> $data['token'],
			]);
		}catch(\Illuminate\Database\QueryException $e){
			DB::rollBack();
			return ([
				'result'	=>	'error',
				'code'		=>	$e->getCode().$e->getMessage(),
				'msg' 		=>	___('Nie można dodać nowego obiektu nawigacji'),
			]);
					
		}
	}
	/**
	 * Aktualizacja pozycji nawigacji
	 */
	public static function zmcms_website_navigation_update($data){
		$wnav = (Config('database.prefix')??'').'website_navigations';
		$wnav_names = (Config('database.prefix')??'').'website_navigations_names';
		$wnav_content = (Config('database.prefix')??'').'website_navigations_content';

		if(strlen($data['token'])==0)$data['token']= hash ( 'sha256' , date('Ymd').rand(0,1000));
		try{
			DB::beginTransaction();
				DB::table($wnav)
				->where('token', $data['token'])
				->update([
					'token'				=> $data['token'],
					'parent'			=> $data['parent'],
					'position'			=> $data['position'],
					'sort'				=> $data['sort'],
					'access'			=> $data['access'],
					'type'				=> $data['type'],
					'active'			=> $data['active'],
					'icon'				=> $data['icon'],
					'ilustration'		=> $data['ilustration'],
					'images_resized'	=> $data['images_resized'],
					'date_from'			=> $data['date_from'],
					'date_to'			=> $data['date_to'],
				]);
				DB::table($wnav_names)
				->where('token', $data['token'])
				->update([
					'token'				=>$data['token'],
					'langs_id'			=>($data['langs_id'] ?? Config(Config('zmcms.frontend.theme_name').'.main.lang_default')),
					'link'				=>$data['link'],
					'link_override'		=>$data['link_override'],
					'name'				=>$data['name'],
					'slug'				=>$data['slug'],
					'meta_keywords'		=>$data['meta_keywords'],
					'meta_description'	=>$data['meta_description'],
					'og_title'			=>$data['og_title'],
					'og_type'			=>$data['og_type'],
					'og_url'			=>$data['og_url'],
					'og_image'			=>$data['og_image'],
					'og_description'	=>$data['og_description'],
				]);
			// if(strlen($data['content'])!=0){

				
			// };
			$tst = DB::table($wnav_content)->where('token', $data['token'])->count();
			if($tst>0)
			if(strlen($data['content'])!=0)
				DB::table($wnav_content)
				->where('token', $data['token'])
				->update([
						'token'		=>$data['token'],
						'langs_id'	=>($data['langs_id'] ?? Config(Config('zmcms.frontend.theme_name').'.main.lang_default')),
						'content'	=>$data['content'],
					]);
			if(strlen($data['content'])==0)
				DB::table($wnav_content)
				->where('token', $data['token'])
				->delete();
			if($tst == 0)
				if(strlen($data['content'])!=0)
				DB::table($wnav_content)->insert([
					'token'		=>$data['token'],
					'langs_id'	=>($data['langs_id'] ?? Config(Config('zmcms.frontend.theme_name').'.main.lang_default')),
						'content'	=>$data['content'],
				]);
			DB::commit();
			return ([
				'result'	=>	'ok',
				'code'		=>	'ok',
				'msg' 		=>	___('Zaktualizowano obiekt nawigacji'),
			]);
		}catch(\Illuminate\Database\QueryException $e){
			DB::rollBack();
			return ([
				'result'	=>	'error',
				'code'		=>	$e->getCode().$e->getMessage(),
				'msg' 		=>	___('Nie zaktualizować obiektu nawigacji'),
			]);
					
		}
	}
	public static function get_navigation_object($token){
		$wnav = (Config('database.prefix')??'').'website_navigations';
		$wnav_names = (Config('database.prefix')??'').'website_navigations_names';
		$wnav_content = (Config('database.prefix')??'').'website_navigations_content';
		$data['resultset'] = DB::table($wnav)
		->leftJoin($wnav_names, $wnav_names.'.token', '=', $wnav.'.token')
		->leftJoin($wnav_content, $wnav_content.'.token', '=', $wnav.'.token')
		->where($wnav_names.'.langs_id', Config(Config('zmcms.frontend.theme_name').'.main.lang_default'))
		->where($wnav.'.token', $token)
		->select([
			$wnav.'.token as token',
    		$wnav.'.parent as parent',
    		$wnav.'.position as position',
    		$wnav.'.sort as sort',
    		$wnav.'.access as access',
    		$wnav.'.type as type',
    		$wnav.'.active as active',
    		$wnav.'.icon as icon',
    		$wnav.'.ilustration as ilustration',
    		$wnav.'.date_from as date_from',
    		$wnav.'.date_to as date_to',
    		$wnav_names.'.langs_id as langs_id',
    		$wnav_names.'.link as link',
    		$wnav_names.'.link_override as link_override',
    		$wnav_names.'.name as name',
    		$wnav_names.'.slug as slug',
    		$wnav_names.'.meta_keywords as meta_keywords',
    		$wnav_names.'.meta_description as meta_description',
    		$wnav_names.'.og_title as og_title',
    		$wnav_names.'.og_type as og_type',
    		$wnav_names.'.og_url as og_url',
    		$wnav_names.'.og_image as og_image',
    		$wnav_names.'.og_description as og_description',
    		$wnav_content.'.content as content',
		])
		->get();
		$arr=[];
		foreach ($data['resultset'] as $key => $value) {
			$arr[$key] = $value;
		}
		return ([
			'result'	=>	'ok',
			'code'		=>	'ok',
			'msg' 		=>	___('Pobrano obiekt nawigacji'),
			'data'		=> $arr,
		]);
	}
	public static function get_navigation_children($tokens = []){
		$wnav = (Config('database.prefix')??'').'website_navigations';
		$children = [];
		$count = DB::table($wnav)->whereIn('parent', $tokens)->count();
		if($count > 0){
			$children = self::get_navigation_children_tokens($tokens);
			$count2 = DB::table($wnav)->whereIn('parent', $children)->count();
			if($count2>0) $children = array_merge($children, self::get_navigation_children($children));
		}

	}
	public static function get_navigation_children_tokens($tokens = []){
		$wnav = (Config('database.prefix')??'').'website_navigations';
		$res = [];
		$resultset =  DB::table($wnav)->whereIn('parent', $tokens)->select([
			'token',
		])
		->get();
		foreach($resultset as $r)
			$res[]=$r->token;

		return $res;
	}
	public static function delete_navigation_object($token){
		$wnav = (Config('database.prefix')??'').'website_navigations';
		$test = DB::table($wnav)
			->where('parent', $token)->count();
		if($test > 0) return json_encode([
			'result'	=>	'error',
			'code'		=>	'childexists',
			'msg' 		=>	___('Nie można usunąć linku - najpierw należy usunąć linki zależne.'),
		]);

		try{
			DB::beginTransaction();
			DB::table($wnav)->where('token', $token)->delete();
			DB::commit();
			return json_encode([
				'result'	=>	'ok',
				'code'		=>	'ok',
				'msg' 		=>	___('Link został usunięty.'),
			]);
			
		}catch(\Illuminate\Database\QueryException $e){
			DB::rollBack();
			return json_encode([
				'result'	=>	'error',
				'code'		=>	'dberror',
				'msg' 		=>	___('Link został usunięty.'),
			]);
		}
		return json_encode([
				'result'	=>	'error',
				'code'		=>	'criticalQ354',
				'msg' 		=>	___('Błąd krytyczny.'),
			]);
	}
	/**
	 * ZWRACA REKORDY LINKÓW NAWIGACJI, DLA KTÓRYCH PRZYPISANO 
	 * WSKAZANY PRZEZ ZMIENNE $token ORAZ $typr OBIEKT
	 */
	public static function linker_links_for_object($token, $type){
		$wnav_linker = (Config('database.prefix')??'').'website_navigations_linker';
		$res = DB::table($wnav_linker)->where('obj_token', $token)->where('obj_type', $type)->get();
		$arr = [];
		foreach ($res as $v) {
			$arr[] = $v->nav_token;
		}
		return $arr;
	}
	public static function zmcms_website_navigations_linker_toggle($navtoken, $linkedobjtoken, $linkedobjtype){
		$wnav_linker = (Config('database.prefix')??'').'website_navigations_linker';
		//DO TABELI "website_navigations_linker"
		$count = DB::table($wnav_linker)->where('nav_token', $navtoken)->where('obj_token', $linkedobjtoken)->where('obj_type', $linkedobjtype)->count();
		if($count>0){
			DB::table($wnav_linker)->where('nav_token', $navtoken)->where('obj_token', $linkedobjtoken)->where('obj_type', $linkedobjtype)->delete();
		}else{
			DB::table($wnav_linker)->insert(['nav_token' => $navtoken,'obj_token' => $linkedobjtoken,'obj_type' => $linkedobjtype,]);
		}
	}



	public static function create_route($path, $parameters){
		$wnav_routes = (Config('database.prefix')??'').'zmcms_routes_table';
		// DB::table($wnav_routes)->insert([
				// 'path'=>$path,
				// 'parameters' => $parameters,
			// ]);
		
		$count = DB::table($wnav_routes)->where('path', $path)->count();
		if($count > 0 )
			DB::table($wnav_routes)->where('path', $path)->delete();
		else
			DB::table($wnav_routes)->insert([
				'path'=>$path,
				'parameters' => $parameters,
			]);
	}
	public static function delete_route($path){
		$wnav_routes = (Config('database.prefix')??'').'zmcms_routes_table';
		DB::table($wnav_routes)->where('path', 'rlike', $path)->delete();
	}
	public static function replace_route($path_old, $path_new, $parameters = null){
		$wnav_routes = (Config('database.prefix')??'').'zmcms_routes_table';
		
		//Routingi dokładnie pasujące do podanego w $path_old aktualizują także parametry
		DB::table($wnav_routes)
				->where('path', '=',$path_old)
				->update([
					'parameters'=>$parameters,
				]);
		$parameters = str_replace('"', '\"', $parameters);
		$sql='UPDATE `zmcms_routes_table` SET `path`= REPLACE(`path`, "'.$path_old.'", "'.$path_new.'") WHERE `path` like "%'.$path_old.'%"';
		DB::statement($sql);
		$sql='UPDATE `zmcms_routes_table` SET `path`= REPLACE(`path`, "'.$path_old.'/", "'.$path_new.'/") WHERE `path` like "%'.$path_old.'/%"';
		DB::statement($sql);
	}


	public static function delete_route_by_params($params){
		$wnav_routes = (Config('database.prefix')??'').'zmcms_routes_table';
		DB::table($wnav_routes)
				->where('parameters', 'rlike', $params)
				->delete();
	}
}
/**
 * 

{"icon":{"15":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg","30":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg","100":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg","200":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg","300":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg","600":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg","800":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg","1024":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg","1400":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg","1980":"\\themes\\milekcompl\\media\\store\\nav\\icons\\kontakt2.jpg"},"ilustration":{"15":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg","30":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg","100":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg","200":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg","300":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg","600":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg","800":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg","1024":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg","1400":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg","1980":"\\themes\\milekcompl\\media\\store\\nav\\ilustrations\\kontakt2.jpg"},"og_image":{"15":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg","30":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg","100":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg","200":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg","300":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg","600":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg","800":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg","1024":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg","1400":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg","1980":"\\themes\\milekcompl\\media\\store\\nav\\og\\kontakt2.jpg"}}

 */