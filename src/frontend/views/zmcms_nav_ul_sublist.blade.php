<li>
<a href="{{$a['link']}}" @if(isset($a['children']) && count($a['children'])>0)id="drop_down_{{$a['token']}}"@endif>{{$a['name']}}</a>
@if(isset($a['children']) && count($a['children'])>0)
@if(view()->exists('themes.'.Config('zmcms.frontend.theme_name').'.frontend.zmcms_nav_ul_list'))
	<ul id="dropped_{{$a['token']}}">
		@each('themes.'.Config('zmcms.frontend.theme_name').'.frontend.zmcms_nav_ul_sublist', $a['children'], 'a')
	</ul>
@else
	<ul id="dropped_{{$a['token']}}">
		@each('zmcms_nav_ul_sublist', $a['children'], 'a')
	</ul>
@endif
@endif
</li>