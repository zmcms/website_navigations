@extends('themes.zmcms.backend.main')
@section('content')
<h1 class="">Link nawigacji w serwisie www</h1>
<div class="control_belt">
	<div class="micro12 ">
		<button class="back_btn"><span class="fas fa-angle-left"></span>Powrót</button>
	</div>
</div>
<div class="control_subbelt_belt">
&nbsp;
</div>
<div>
	<form class="micro12" id="zmcms_website_navigation_create_link_frm" method="post" enctype="multipart/form-data">
        <div class="tabs">
            <div id="tab_1" class="tab active">Dane podstawowe</div>
            <div id="tab_3" class="tab">SEO / SEM</div>
        </div>
        <div id="tabcontent_1" class="tabcontent active">
            <label class="micro6">
                <span class="micro12 mini2">Nazwa</span>
                <input class="micro12 mini10 required" type="text" id="zw_nav_name_txt" name="name" value="{{$data->name ?? null}}" placeholder="Nazwa">
            </label>
            <label class="micro6">
                <span class="micro12 mini2">Slug</span>
                <input class="micro12 mini10 required" type="text" id="zw_nav_slug_txt" name="slug" value="{{$data->slug ?? null}}" placeholder="Slug">
            </label>
            <label class="micro12">
                <span class="micro12 mini2">Link</span>
                <input class="micro12 mini10 required" type="text" id="zw_nav_link_txt" name="link" value="{{$data->link ?? null}}" placeholder="Link, który prowadzi do niniejszej pozycji">
            </label>
            <label class="micro3">
                <span class="micro12 mini5">Sort</span>
                <input class="micro12 mini7" type="text" name="sort" value="{{$data->sort ?? null}}" placeholder="Kolejność wyświetlania">
            </label>
            <label class="micro3">
                <span class="micro12 mini5">Dostęp</span>
                <select class="micro12 mini7 required" name="access">
                    @foreach(Config(Config('zmcms.frontend.theme_name').'.user_roles') as  $r => $v)
                        <option value="{{$r}}">{{$v['name']}}</option>
                    @endforeach
                </select>
            </label>
            <label class="micro3">
                <span class="micro12 mini5">Data od</span>
                <input class="micro12 mini7 required" type="date" name="date_from" value="{{$data->date_from ?? date('Y-m-d')}}" placeholder="Od kiedy wyświetlać?">
            </label>
            <label class="micro3">
                <span class="micro12 mini5">Data do</span>
                <input class="micro12 mini7" type="date" name="date_to" value="{{$data->date_to ?? null}}" placeholder="Do kiedy wyświetlać?">
            </label>
            <label class="micro3">
                <span class="micro12 mini5">Aktywna?</span>
                {{-- <input class="micro12 mini7 required" type="text" name="active" value="{{$data->xxxx ?? null}}" placeholder="1 - aktywna, 0 -
                nieaktywna">  --}}
                <select class="micro12 mini7 required" name="active">
                    @foreach(Config(Config('zmcms.frontend.theme_name').'.website_navigations') as  $r => $v)
                        <option value="0">{{___('NIE')}}</option>
                        <option value="1">{{___('TAK')}}</option>
                    @endforeach
                </select>
            </label>
            <label class="micro3">
                <span class="micro12 mini5">Język</span>
                <input class="micro12 mini7 required" type="text" name="langs_id" value="{{$data->langs_id ?? Config(Config('zmcms.frontend.theme_name').'.main.lang_default')}}" placeholder="Język wpisu?">
            </label>
            <label class="micro6">
                <span class="micro12 mini3">Rodzaj</span>
                <select class="micro12 mini9 required" name="type">
                    @foreach(Config(Config('zmcms.frontend.theme_name').'.website_navigations') as  $r => $v)
                        <option value="{{$r}}">{{$v['name']}}</option>
                    @endforeach
                </select>
            </label>
            <label class="micro6">
                <span class="micro12 mini3">Ikona</span>
                <input class="micro12 mini9" type="text" name="icon" value="{{$data->icon ?? null}}" placeholder="Ikona wpisu">
            </label>
            <label class="micro6">
                <span class="micro12 mini3">Ilustracja</span>
                <input class="micro12 mini9" type="text" name="ilustration" value="{{$data->text ?? null}}" placeholder="Ilustracja wpisu">
            </label>
            <label class="micro12">
                <span class="micro12">Treść</span>
                <textarea class="richeditor micro12" type="text" cols="25" rows="40" name="content" placeholder="Jeżeli pozycja jest samodzielna, tu dodajemy wpis" >
                    {{$data->content ?? null}}
                </textarea>
            </label>
        </div>
        <div id="tabcontent_3" class="tabcontent">
            <label class="micro12">
                <span class="micro12 mini3">Słowa kluczowe</span>
                <input class="micro12 mini9" type="text" name="meta_keywords" value="{{$data->meta_keywords ?? null}}" placeholder="Słowa kluczowe w sekcji HEAD">
            </label>
            <label class="micro12">
                <span class="micro12 mini3">Opis dokumentu</span>
                <input class="micro12 mini9" type="text" name="meta_description" value="{{$data->meta_description ?? null}}" placeholder="Opis dokumentu w sekcji HEAD">
            </label>
            <label class="micro12">
                <span class="micro12 mini3">OPEN GRAPH - Tytuł</span>
                <input class="micro12 mini9" type="text" name="og_title" value="{{$data->og_title ?? null}}" placeholder="Opis dokumentu w sekcji HEAD">
            </label>
            <label class="micro12">
                <span class="micro12 mini3">OPEN GRAPH - Opis</span>
                <input class="micro12 mini9" type="text" name="og_description" value="{{$data->og_description ?? null}}" placeholder="Ilustracja opisany w formacie Open Graph">
            </label>
            <label class="micro6">
                <span class="micro12 mini3">OPEN GRAPH - Rodzaj dokumentu</span>
                <input class="micro12 mini9" type="text" name="og_type" value="{{$data->og_type ?? null}}" placeholder="Rodzaj dokumentu opisany w formacie Open Graph">
            </label>
            <label class="micro6">
                <span class="micro12 mini3">OPEN GRAPH - Link do dokumentu</span>
                <input class="micro12 mini9" type="text" name="og_url" value="{{$data->og_url ?? null}}" placeholder="Link do dokumentu opisany w formacie Open Graph">
            </label>
            <label class="micro12">
                <span class="micro12 mini3">OPEN GRAPH - Ilustracja</span>
                <input class="micro12 mini9" type="text" name="og_image" value="{{$data->og_image ?? null}}" placeholder="Ilustracja opisany w formacie Open Graph">
            </label>
        </div>
		<label class="micro12">
            <input class="micro12" type="text" name="action" value="{{$settings['action'] ?? null}}" placeholder="Generowanie tokenu rekordu">
            <input class="micro12" type="text" name="token" value="{{$data->token ?? null}}" placeholder="Generowanie tokenu rekordu">
            <input class="micro12" type="text" name="parent" value="{{$data->parent ?? null}}" placeholder="Rodzic pozycji nawigacji">
            <input class="micro12" type="text" name="position" value="{{$data->position ?? $settings['position']}}" placeholder="Pozycja nawigacji">
			{{-- <input class="micro12" type="text" name="link" value="{{$data->xxxx ?? null}}" placeholder="Wygenerowany automatycznie link"> --}}
			<input class="micro12" type="text" name="link_override" value="{{$data->link_override ?? null}}" placeholder="Nadpisany link">
        </label>
        <div class="msg"></div>
        <button id="btn_save">{{$settings['btnsave']}}</button>
        

	</form>
	<pre>
		{{print_r(
			$data, true)}}
	</pre>
</div>
@endsection



{{-- token --}}
{{-- langs_id --}}
{{-- link --}}
{{-- link_override --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}