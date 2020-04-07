@extends('themes.zmcms.backend.main')
@section('content')
<h1 class="">Pozycje nawigacji w serwisie www</h1>
<div id="types_list" class="res_table micro12">
	<div class="control_belt">
		<a id="wntbtnnew" href="#"><span class="fas fa-plus"></span></a>
	</div>
	<div class="content micro12">
	@include('themes.zmcms.backend.zmcms_website_navigations_types_ajax_content')
	</div>
</div>
	{{-- <pre>{{print_r($data, true)}}</pre> --}}
@endsection
