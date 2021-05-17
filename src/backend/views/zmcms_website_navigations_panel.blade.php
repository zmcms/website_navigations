@extends('themes.zmcms.backend.main')
@section('content')
<h1 class="">Zarządzanie nawigacją w serwisie www</h1>
<div id="zmcms_website_navigations_control_panel" class="control_belt" style="text-align: right;">
	<div class="micro12 ">
	@foreach($data['positions'] as $p)
	<button id="zmcms_website_navigations_tab_{{$loop->iteration}}" data-position="{{$p->position}}">{{$p->name}}</button>
	@endforeach
	<button id="btn_positions_list"><span class="fas fa-tasks"></span></button>
	<button id="btn_navigations_new_link"><span class="fas fa-plus"></span> Nowy link</button>
	</div>
	
</div>
<div id="zmcms_website_navigations_control_panel_content">
	
</div>
@endsection
