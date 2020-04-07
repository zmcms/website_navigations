@extends('themes.zmcms.backend.main')
@section('content')
<h1 class="">Pozycje nawigacji w serwisie www</h1>
<div class="control_belt">
		<button id="position_new" href="#"><span class="fas fa-plus"></span></button>
		<button class="back_btn"><span class="fas fa-angle-left" aria-hidden="true"></span>Powrót</button>
	</div>
<div id="positions_list" class="res_table micro12">
	<div class="header micro12 hide_pc">
		<div class="micro12 mini2">Kod</div>
		<div class="micro12 mini9">Nazwa</div>
		<div class="micro12 mini1">&nbsp;</div>
	</div>
	<div class="content micro12">
	@include('themes.zmcms.backend.zmcms_website_navigations_positions_ajax_content')
	</div>
</div>
	{{-- <pre>{{print_r($data, true)}}</pre> --}}
@endsection
