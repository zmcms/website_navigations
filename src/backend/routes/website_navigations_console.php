<?php
	Artisan::command('zmcms_website_navigations_load', function (){
	    require(getcwd().'/vendor/zmcms/website_navigations/src/dummy/example_data.php');
	});