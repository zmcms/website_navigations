{{-- @foreach($data as $d) --}}
{{-- <div id="row_{{$loop->iteration}}"> --}}
	{{-- <div class="micro12 mini2"><span class="micro3 hide_mobile label">Kod:</span><span class="micro9 mini12 small12 label"id="type_code_{{$loop->iteration}}">{{$d->type}}</span></div> --}}
	{{-- <div class="micro12 mini9"><span class="micro3 hide_mobile label">Nazwa:</span><span class="micro9 mini12 small12 label" id="type_name_{{$loop->iteration}}">{{$d->name}}</span></div> --}}
	{{-- <div class="micro12 mini1"> --}}
		{{-- <a id="type_edit_{{$loop->iteration}}" href="#"><span class="far fa-edit"></span></a> --}}
   	    {{-- <a id="type_del_{{$loop->iteration}}" href="#"><span class="fas fa-trash-alt"></span></a> --}}
	{{-- </div> --}}
{{-- </div> --}}
{{-- @endforeach --}}
<div class="msg.info">
	<p>Przypisujemy kontrolery oraz metody kontrolerów dla poszczególnych rodzajów linków w nawigacji w formacie <strong>"kontroler@metoda"</strong>.</p>
	<p>Wypełnianie tego formularza zalecamy osobom znającym programowanie obiektowe w PHP, które rozumieją przestrzenie nazw w tym języku oraz rozumieją arhitekturę frameworka na bazie którego zbudowano niniejszy system.</p>
	<p><strong>Zdecydowanie zalecamy zapisanie bieżących wartości formularza w innej lokalizacji.</strong> Można to zrobić np. przez skopiowanie w bezpieczne miejsce pliku "/config/zmcms/website_navigations.php".</p>

</div>
@if(count($data)>0)
@foreach($data as $key => $type)
<div class="micro12" id="row_{{$loop->iteration}}">
	<div class="micro12">
		<span class="micro3 label strong">Kod:</span><span class="micro9 label strong" id="type_code_{{$loop->iteration}}">{{$key}}</span>
	</div>
	<div class="micro12">
		<span class="micro3 label">Nazwa:</span><span class="micro9 label" id="type_name_{{$loop->iteration}}">{{$type['name'] ?? 'Nie uzupełniono'}}</span>
	</div>
	<div class="micro12">
		<span class="micro3 label">Pojedynczy obiekt:</span><span class="micro9 label" id="type_single_{{$loop->iteration}}">{{$type['single'] ?? 'Nie uzupełniono'}}</span>
	</div>
	<div class="micro12">
		<span class="micro3 label">Lista obiektów:</span><span class="micro9 label" id="type_list_{{$loop->iteration}}">{{$type['list'] ?? 'Nie uzupełniono'}}</span>
	</div>
	<div class="micro12">
		<span class="micro3 label">Krótki opis kategorii "{{$type['name'] ?? 'Nie uzupełniono'}}":</span><span class="micro9 label" id="type_list_{{$loop->iteration}}">{!!$type['description'] ?? '&nbsp;'!!}</span>
	</div>
		<div class="micro12 control_belt">
		<a id="type_edit_{{$loop->iteration}}" href="#"><span class="far fa-edit"></span></a>
   	    <a id="type_del_{{$loop->iteration}}" href="#"><span class="fas fa-trash-alt"></span></a>
	</div>
</div>
@endforeach
@endif
