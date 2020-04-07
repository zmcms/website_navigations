
@if(isset($data['resultset']))
<ul class="navigations_tree">
@foreach($data['resultset'] as $r)
<li>
	<a id="navigation_new_link_{{$r['token']}}" data-token="{{$r['token']}}" href="#"><span class="fas fa-plus"></span></a>
	<a id="navigation_edit_{{$r['token']}}" data-token="{{$r['token']}}" href="#"><span class="far fa-edit"></span></a>
   	<a id="navigation_del_{{$r['token']}}" data-token="{{$r['token']}}" href="#"><span class="fas fa-trash-alt"></span></a>
	<a href="{{$r['link']}}" target="_blank">{{$r['name']}}</a>
@if(isset($r['children']) && count($r['children'])>0)
	<ul>
		@each('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_nav_ul_sublist', $r['children'], 'a')
	</ul>
@endif
</li>
@endforeach
</ul>
@endif