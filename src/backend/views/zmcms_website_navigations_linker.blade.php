<div class="linker msg ok">
	<h1>Linker</h1>
		@if(isset($data))
			@foreach($data as $key => $x)
			
			<label for="linker_tab_{{$loop->iteration}}" id="linker_tab_lbl_{{$loop->iteration}}">{{ $positions[$key] }}</label>
			<input id="linker_tab_{{$loop->iteration}}" type="radio" name="linker_tab">
			
				<ul class="linker_tree">
					@foreach($x as $r)
						<li>
							@if(in_array($r['token'], $linked))
								<a 
									data-navtoken="{{$r['token']}}" 
									data-navslug="{{$r['slug']}}" 
									data-linkedobjtoken="{{$linked_object['token']}}" 
									data-linkedobjtype="{{$linked_object['type']}}" 
									data-linkedobjslug="{{$linked_object['slug']}}" 
									id="linker_btn_{{$r['token']}}" href="{{$r['link']}}" target="_blank"><span class="fas fa-circle"></span><span>{{$r['name']}}</span></a>
							@else
								<a 
									data-navtoken="{{$r['token']}}" 
									data-navslug="{{$r['slug']}}" 
									data-linkedobjtoken="{{$linked_object['token']}}" 
									data-linkedobjtype="{{$linked_object['type']}}" 
									data-linkedobjslug="{{$linked_object['slug']}}" 
									id="linker_btn_{{$r['token']}}" href="{{$r['link']}}" target="_blank"><span class="far fa-circle"></span><span>{{$r['name']}}</span></a>
							@endif
							@if(isset($r['children']) && count($r['children'])>0)
								<ul>
									@foreach($r['children'] as $a)
									{{view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_linker_children', compact('a', 'linked', 'linked_object'))}}
									@endforeach
								</ul>
							@endif
						</li>
					@endforeach
				</ul>
			@endforeach
		@endif
</div>
<script type="text/javascript">
		$('#ajax_dialog_box_content').on('click', '*[id^="linker_tab_lbl_"]', function(e){
		e.preventDefault();e.stopPropagation();
		var o = $(this).attr('id'); 
		var fr = $(this).attr('for'); 
		var d = document.getElementById(o);
		// alert(fr);
		$("#"+fr).prop("checked", true);
	});
</script>