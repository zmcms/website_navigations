@foreach($data as $d)
<div id="row_{{$loop->iteration}}">
	<div class="micro12 mini2"><span class="micro3 hide_mobile label">Kod:</span><span class="micro9 mini12 small12 label"id="position_code_{{$loop->iteration}}">{{$d->position}}</span></div>
	<div class="micro12 mini9"><span class="micro3 hide_mobile label">Nazwa:</span><span class="micro9 mini12 small12 label" id="position_name_{{$loop->iteration}}">{{$d->name}}</span></div>
	<div class="micro12 mini1 control_belt">
		<a id="position_edit_{{$loop->iteration}}" href="#"><span class="far fa-edit"></span></a>
   	    <a id="position_del_{{$loop->iteration}}" href="#"><span class="fas fa-trash-alt"></span></a>
	</div>
</div>
@endforeach