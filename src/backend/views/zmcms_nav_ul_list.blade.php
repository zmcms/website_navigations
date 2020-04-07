@if(isset($data['resultset']))
@foreach($data['resultset'] as $r)
<li>
	<a href="{{$r['link']}}">{{$r['name']}}</a>
@if(isset($r['children']) && count($r['children'])>0)
@if(view()->exists('themes.'.Config('frontend.theme_name').'.zmcms.website_navigations.frontend.zmcms_nav_ul_list'))
	<ul>
		@each('themes.'.Config('frontend.theme_name').'.zmcms.website_navigations.frontend.zmcms_nav_ul_sublist', $r['children'], 'a')
	</ul>
@else
	<ul>
		@each('zmcms_nav_ul_sublist', $r['children'], 'a')
	</ul>
@endif
@endif
</li>
@endforeach
@endif