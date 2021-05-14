@extends('themes.'.Config('zmcms.frontend.theme_name').'.backend.main')
@section('content')
<h1 class="">Pozycje nawigacji w serwisie www</h1>
<div class="control_belt" style="text-align: right;">
	<button id="position_new" href="#"><span class="fas fa-plus"></span></button>
</div>
<div id="positions_list" class="res_table micro12">
	<div class="content micro12">
	@include('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_positions_ajax_content')
	</div>
</div>
	{{-- <pre>{{print_r($data, true)}}</pre> --}}
@endsection
