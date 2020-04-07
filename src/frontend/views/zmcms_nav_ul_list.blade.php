
@if(isset($data['resultset']))
@foreach($data['resultset'] as $r)
<li>
	<a href="{{$r['link']}}" @if(isset($r['children']) && count($r['children'])>0)id="drop_down_{{$r['token']}}"@endif >{{$r['name']}}</a>
@if(isset($r['children']) && count($r['children'])>0)
<ul id="dropped_{{$r['token']}}">
		@each('themes.'.Config('zmcms.frontend.theme_name').'.frontend.zmcms_nav_ul_sublist', $r['children'], 'a')
</ul>
@endif
</li>
@endforeach
@endif