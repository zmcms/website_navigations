@foreach($data as $d)
<div id="row_{{$loop->iteration}}" class="micro12">
	<div class="micro12 mini2">
		<input type="text" id="position_code_{{$loop->iteration}}" value="{{$d->position}}"/>
		<label>Kod</label>
	</div>
	<div class="micro12 mini8">
		<input type="text" id="position_name_{{$loop->iteration}}" value="{{$d->name}}"/>
		<label>Nazwa</label>
	</div>
	<div class="micro12 mini1">
		<a style="font-size: 2rem" id="position_edit_{{$loop->iteration}}" href="#"><span class="far fa-edit"></span></a>
	</div>
	<div class="micro12 mini1">
		<a style="font-size: 2rem" id="position_del_{{$loop->iteration}}" href="#"><span class="fas fa-trash-alt"></span></a>
	</div>
</div>
@endforeach