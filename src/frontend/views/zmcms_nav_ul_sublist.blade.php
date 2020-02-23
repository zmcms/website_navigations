<li>
<a href="{{$a['link']}}">{{$a['name']}}</a>
@if(isset($a['children']) && count($a['children'])>0)
@if(view()->exists('themes.'.Config('frontend.theme_name').'.zmcms.website_navigations.frontend.zmcms_nav_ul_list'))
	<ul>
		@each('themes.'.Config('frontend.theme_name').'.zmcms.website_navigations.frontend.zmcms_nav_ul_sublist', $a['children'], 'a')
	</ul>
@else
	<ul>
		@each('zmcms_nav_ul_sublist', $a['children'], 'a')
	</ul>
@endif
@endif
</li>