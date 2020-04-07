{{-- @extends('themes.zmcms.backend.main') --}}
{{-- @section('content') --}}
<h1 class="">Nowa pozycja nawigacji w serwisie</h1>
<form class="micro12" id="zmcms_website_navigation_position_new_frm" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="{{$settings['action']}}">
    <input type="hidden" name="position_old" value="{{$data[0]->position ?? null}}">    
    {!! csrf_field() !!}
    <fieldset>
        <label class="micro12 mini4">
            <span class="micro12 mini2">Kod</span>
            <input class="micro12 mini10" type="text" name="position" value="{{$data[0]->position ?? null}}" placeholder="Kod pozycji">
        </label>
        <label class="micro12 mini8">
            <span class="micro12 mini2">Nazwa</span>
            <input class="micro12 mini10" type="text" name="name" value="{{$data[0]->name ?? null}}" placeholder="Nazwa pozycji">
        </label>
    </fieldset>
    {{-- <pre>{{print_r($data, true)}}</pre> --}}
    <div class="msg"></div>
    <button id="btn_save">{{$settings['btnsave']}}</button>
</form>
{{-- @endsection --}}
