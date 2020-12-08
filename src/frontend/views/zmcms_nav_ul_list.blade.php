
@if(isset($data['resultset']))
@foreach($data['resultset'] as $r)
<li>
	<a href="{{(strlen($r['link_override'])>0)?$r['link_override']:$r['link']}}" @if(isset($r['children']) && count($r['children'])>0)id="drop_down_{{$r['token']}}"@endif >
		{{$r['name']}}
		@if(isset($r['children']) && count($r['children'])>0)<span class="fas fa-caret-down" aria-hidden="true"></span>@endif
	</a>
@if(isset($r['children']) && count($r['children'])>0)
<ul id="dropped_{{$r['token']}}" class="hidden">
		@each('themes.'.Config('zmcms.frontend.theme_name').'.frontend.zmcms_nav_ul_sublist', $r['children'], 'a')
</ul>
@endif
</li>
@endforeach
@endif


