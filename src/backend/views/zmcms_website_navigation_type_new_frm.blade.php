{{-- @extends('themes.zmcms.backend.main') --}}
{{-- @section('content') --}}
<form class="micro12" id="zmcms_website_navigation_type_new_frm" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="{{$settings['action']}}">
    <input type="hidden" name="type_old" value="{{$data['type'] ?? null}}">
    {!! csrf_field() !!}
    <fieldset>
        <label class="micro12 mini4">
            <span class="micro12 mini2">Kod</span>
            <input class="micro12 mini10" type="text" name="type" value="{{$data['type'] ?? null}}" placeholder="Kod rodzaju nawigacji">
        </label>
        <label class="micro12 mini8">
            <span class="micro12 mini2">Nazwa</span>
            <input class="micro12 mini10" type="text" name="name" value="{{$data['name'] ?? null}}" placeholder="Nazwa rodzaju nawigacji">
        </label>
        <label class="micro12 mini12">
            <span class="micro12">Krótki opis</span>
            <textarea class="micro12" name="description" placeholder="Opisz krótko rodzaj nawigacji">{{$data['description'] ?? null}}</textarea>
        </label>
        <label class="micro12 mini12">
            <span class="micro12 mini2">Uruchom</span>
            <input class="micro12 mini10" type="text" name="run" value="{{$data['run'] ?? null}}" placeholder="Metoda wywołująca pojedynczy obiekt">
        </label>
    </fieldset>
    {{-- <pre>{{print_r($data, true)}}</pre> --}}
    <div class="msg"></div>
    <button id="btn_save">{{$settings['btnsave']}}</button>
</form>
