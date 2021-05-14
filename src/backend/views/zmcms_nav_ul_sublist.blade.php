<li>
<a id="navigation_new_link_{{$a['token']}}" data-token="{{$a['token']}}" href="#"><span class="fas fa-plus"></span></a>
<a id="navigation_edit_{{$a['token']}}" data-token="{{$a['token']}}" href="#"><span class="far fa-edit"></span></a>
<a id="navigation_del_{{$a['token']}}" data-token="{{$a['token']}}" href="#"><span class="fas fa-trash-alt"></span></a>
<a href="{{$a['link']}}" target="_blank">{{$a['name']}}</a>
@if(isset($a['children']) && count($a['children'])>0)
	<ul>
		@each('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_nav_ul_sublist', $a['children'], 'a')
	</ul>
@endif
</li>