<li>
@if(in_array($a['token'], $linked))
	<a 
		data-navtoken="{{$a['token']}}" 
		data-navslug="{{$a['slug']}}" 
		data-linkedobjtoken="{{$linked_object['token']}}" 
		data-linkedobjtype="{{$linked_object['type']}}"
		data-linkedobjslug="{{$linked_object['slug']}}" 
		id="linker_btn_{{$a['token']}}" href="{{$a['link']}}" target="_blank"><span class="fas fa-circle"></span><span>{{$a['name']}}</span></a>
@else
	<a 
		data-navtoken="{{$a['token']}}"
		data-navslug="{{$a['slug']}}" 
		data-linkedobjtoken="{{$linked_object['token']}}"
		data-linkedobjtype="{{$linked_object['type']}}"
		data-linkedobjslug="{{$linked_object['slug']}}"
		id="linker_btn_{{$a['token']}}" href="{{$a['link']}}" target="_blank"><span class="far fa-circle"></span><span>{{$a['name']}}</span></a>
@endif
@if(isset($a['children']) && count($a['children'])>0)
	<ul>
		@foreach($a['children'] as $a)
		{{view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_linker_children', compact('a', 'linked', 'linked_object'))}}
		@endforeach
	</ul>
@endif
</li>