@extends('themes.zmcms.backend.main')
@section('content')
<h1 class="">Pozycje nawigacji w serwisie www</h1>
<div class="res_table micro12">
	<div class="control_belt">
		<a id="position_new" href="#"><span class="fas fa-plus"></span></a>
	</div>
	<div class="header micro12 hide_pc">
		<div class="micro12 mini2">Kod</div>
		<div class="micro12 mini9">Nazwa</div>
		<div class="micro12 mini1">&nbsp;</div>
	</div>
	<div class="content micro12">
	@foreach($data as $d)
	<div>
		<div class="micro12 mini2"><span class="micro3 hide_mobile label">Kod:</span><span class="micro9 mini12 small12 label"id="position_code_{{$loop->iteration}}">{{$d->position}}</span></div>
		<div class="micro12 mini9"><span class="micro3 hide_mobile label">Nazwa:</span><span class="micro9 mini12 small12 label" id="position_name_{{$loop->iteration}}">{{$d->name}}</span></div>
		<div class="micro12 mini1">
			<a id="position_edit_{{$loop->iteration}}" href="#"><span class="far fa-edit"></span></a>
    	    <a id="position_del_{{$loop->iteration}}" href="#"><span class="fas fa-trash-alt"></span></a>
		</div>
	</div>
	@endforeach
	</div>
</div>
	{{-- <pre>{{print_r($data, true)}}</pre> --}}
@endsection
