<li>
<a href="{{(strlen($a['link_override'])>0)?$a['link_override']:$a['link']}}" @if(isset($a['children']) && count($a['children'])>0)id="drop_down_{{$a['token']}}"@endif>
{{$a['name']}}
@if(isset($a['children']) && count($a['children'])>0)<span class="fas fa-caret-down" aria-hidden="true"></span>@endif
</a>
@if(isset($a['children']) && count($a['children'])>0)
	<ul id="dropped_{{$a['token']}}" class="hidden">
		@each('themes.'.Config('zmcms.frontend.theme_name').'.frontend.zmcms_nav_ul_sublist', $a['children'], 'a')
	</ul>
@endif
</li>