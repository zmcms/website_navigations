<form class="micro12" id="zmcms_website_navigation_type_new_frm" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="{{$settings['action']}}">
    <input type="hidden" name="type_old" value="{{$data['type'] ?? null}}">
    {!! csrf_field() !!}
    <fieldset>
        <div class="micro12">
            <input type="text" name="type" value="{{$data['type'] ?? null}}" placeholder=" ">
            <label>Kod rodzaju nawigacji</label>
        </div>
        <div class="micro12">
            <input type="text" name="name" value="{{$data['name'] ?? null}}" placeholder=" ">
            <label>Nazwa rodzaju nawigacji</label>
        </div>
        <div class="micro12">
            <textarea name="description" placeholder=" ">{{$data['description'] ?? null}}</textarea>
            <label>Krótki opis</label>
        </div>
        <div class="micro12">
            <input type="text" name="run" value="{{$data['run'] ?? null}}" placeholder=" ">
            <label>Uruchom</label>
        </div>
    </fieldset>
    {{-- <pre>{{print_r($data, true)}}</pre> --}}
    <div class="msg"></div>
    <button id="btn_save">{{$settings['btnsave']}}</button>
</form>
