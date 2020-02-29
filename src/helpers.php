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
