<?php
function zmcms_website_navigations_frontend($position = 'main', $parent = null){
	return (new \Zmcms\WebsiteNavigations\Frontend\Controllers\ZmcmsWebsiteNavigationsController())->render();
}
