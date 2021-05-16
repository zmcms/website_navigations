<?php
function zmcms_website_navigations_frontend($position = 'main', $parent = null, $to_file=false){
	$txt = (new \Zmcms\WebsiteNavigations\Frontend\Controllers\ZmcmsWebsiteNavigationsController())->render($position);
	if($to_file){
		if(!is_dir('../resources/views/themes/zmcms/frontend/rendered'))
			mkdir('../resources/views/themes/zmcms/frontend/rendered', 0755, true);
		$myfile = fopen('../resources/views/themes/zmcms/frontend/rendered/website_navigations_frontend_'.$position.'.blade.php', "w");
		fwrite($myfile, $txt);
		fclose($myfile);
		return $txt;
	}else{
		return $txt;
	}
}

function zmcms_website_homepage($position = 'main', $parent = null, $to_file=false){
	$txt = (new \Zmcms\WebsiteNavigations\Frontend\Controllers\ZmcmsWebsiteNavigationsController())->render($position);
	if($to_file){
		if(!is_dir('../resources/views/themes/zmcms/frontend/rendered'))
			mkdir('../resources/views/themes/zmcms/frontend/rendered', 0755, true);
		$myfile = fopen('../resources/views/themes/zmcms/frontend/rendered/website_navigations_frontend_'.$position.'.blade.php', "w");
		fwrite($myfile, $txt);
		fclose($myfile);
		return $txt;
	}else{
		return $txt;
	}	
}

function zmcms_website_homepage_categories($position = 'main', $order = []){
	$tblNamePrefix=(Config('database.prefix')??'');
	$navigations=$tblNamePrefix.'website_navigations';
	$navigations_names=$tblNamePrefix.'website_navigations_names';
	$navigations_content=$tblNamePrefix.'website_navigations_content';
	return DB::table($navigations)
		->join($navigations_names, $navigations.'.token', '=', $navigations_names.'.token')
		->leftJoin($navigations_content, $navigations.'.token', '=', $navigations_content.'.token')
		->where('position', $position)
		->where($navigations_names.'.langs_id', 'pl')
		->when(($order != []), function ($query) use ($order){
			foreach($order as $k => $v){
				$query->orderBy($k, $v);
			}
			return $query;
		})
		->get();
}

function zmcms_website_navigations_backend($position = 'main', $parent = null, $to_file=false){
	
}
