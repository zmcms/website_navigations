@extends('themes.'.Config('zmcms.frontend.theme_name').'.backend.main')
@section('content')
<h1 class="">Link nawigacji w serwisie www</h1>
    <form  id="zmcms_website_navigation_create_link_frm" method="post" enctype="multipart/form-data">
        <div class="micro12 mini6 small4">
                <input  type="text" id="zw_nav_name_txt" name="name" value="{{$data->name ?? null}}" placeholder=" ">
                <label>Nazwa</label>
        </div>
        <div class="micro12 mini6 small4">
                <input  type="text" id="zw_nav_slug_txt" name="slug" value="{{$data->slug ?? null}}" placeholder=" ">
                <label>Slug</label>
        </div>
        <div class="micro12 mini4 small4">
                <input  type="text" id="zw_nav_link_txt" name="link" value="{{$data->link ?? null}}" placeholder=" ">
                <label>Link</label>
        </div>
        <div class="micro6 mini4 small1">
                <input  type="text" name="sort" value="{{$data->sort ?? null}}" placeholder=" ">
                <label>Sort</label>
        </div>
        <div class="micro6 mini4 small2">
                <select  name="access">
                    @foreach(Config(Config('zmcms.frontend.theme_name').'.user_roles') as  $r => $v)
                        <option value="{{$r}}">{{$v['name']}}</option>
                    @endforeach
                </select>
                <label>Dostęp</label>
        </div>
        <div class="micro6 mini4 small2">
                <input  type="date" name="date_from" value="{{$data->date_from ?? date('Y-m-d')}}">
                <label>Data od</label>
        </div>
        <div class="micro6 mini4 small2">
                <input  type="date" name="date_to" value="{{$data->date_to ?? null}}" placeholder=" ">
                <label>Data do</label>
        </div>
        <div class="micro6 mini2 small2">
                <select  name="active">
                    <option value="0" @if( ($data->active ?? null)=='0' )selected="selected"@endif>{{___('NIE')}}</option>
                    <option value="1" @if( ($data->active ?? null)=='1' )selected="selected"@endif>{{___('TAK')}}</option>
                </select>
                <label>Aktywna?</label>
        </div>
        <div class="micro6 mini2 small1">
                <input  type="text" name="langs_id" value="{{$data->langs_id ?? Config(Config('zmcms.frontend.theme_name').'.main.lang_default')}}" placeholder=" ">
                <label>Język</label>
        </div>
        <div class="micro12 small2">
                <select  name="type">
                    @foreach(Config(Config('zmcms.frontend.theme_name').'.website_navigations') as  $r => $v)
                        <option value="{{$r}}" @if( ($data->type ?? null)==$r )selected="selected"@endif >{{$v['name']}}</option>
                    @endforeach
                </select>
                <label>Rodzaj</label>
        </div>
        <div class="micro12 small6">
            <div class="micro8 mini8">
                <input id="zcwn_btn_icon_fld"  type="text" name="icon" value="{{$data->icon ?? null}}" placeholder=" ">
                <label>Ikona</label>
            </div>
            <div class="micro2 mini2">
                <button id="zcwn_btn_update_icon" data-selectfld="zcwn_btn_icon_fld" ><span class="fas fa-plus"></span></button>
            </div>
            <div class="micro2 mini2">
                <button id="zcwn_btn_remove_icon" data-selectfld="zcwn_btn_icon_fld" ><span class="fas fa-trash"></span></button>
            </div>
        </div>
        <div class="micro12 small6">
            <div class="micro8 mini8">                
                <input id="zcwn_btn_ilustration_fld"  type="text" name="ilustration" value="{{$data->ilustration ?? null}}" placeholder=" ">
                <label>Ilustracja</label>
            </div>                
            <div class="micro2 mini2">
                <button id="zcwn_btn_update_ilustration" data-selectfld="zcwn_btn_ilustration_fld" ><span class="fas fa-plus"></span></button>
            </div>                
            <div class="micro2 mini2">                
                <button id="zcwn_btn_remove_ilustration" data-selectfld="zcwn_btn_ilustration_fld" ><span class="fas fa-trash"></span></button>
            </div>
        </div>
        <div class="micro12">
                <h3>Treść</h3>
                <textarea class="richeditor" name="content" placeholder="Jeżeli pozycja jest samodzielna, tu dodajemy wpis" >
                    {{$data->content ?? null}}
                </textarea>
        </div>
        <h2>Nagłówek HEAD</h2>
        <div class="micro12">
                <input  type="text" name="meta_keywords" value="{{$data->meta_keywords ?? null}}" placeholder=" ">
                <label>Słowa kluczowe</label>
        </div>
        <div class="micro12">
                <input  type="text" name="meta_description" value="{{$data->meta_description ?? null}}" placeholder=" ">
                <label>Opis dokumentu</label>
        </div>
        <div class="micro12">
                <input  type="text" name="og_title" value="{{$data->og_title ?? null}}" placeholder=" ">
                <label>OPEN GRAPH - Tytuł</label>
        </div>
        <div class="micro12">
                <input  type="text" name="og_description" value="{{$data->og_description ?? null}}" placeholder=" ">
                <label>OPEN GRAPH - Opis</label>
        </div>
        <div class="micro12 small4">
                <input  type="text" name="og_type" value="{{$data->og_type ?? null}}" placeholder=" ">
                <label>OPEN GRAPH - Rodzaj dokumentu</label>
        </div>
        <div class="micro12 small8">
                <input  type="text" name="og_url" value="{{$data->og_url ?? null}}" placeholder=" ">
                <label>OPEN GRAPH - Link do dokumentu</label>
        </div>
        <div class="micro12">
            <div class="micro8 mini8">                
                <input id="zcwn_btn_og_ilustration_fld"  type="text" name="og_image" value="{{$data->og_image ?? null}}" placeholder=" ">
                <label>OPEN GRAPH - Ilustracja</label>
            </div>                            
            <div class="micro2 mini2">
                <button id="zcwn_btn_update_og_ilustration" data-selectfld="zcwn_btn_og_ilustration_fld" ><span class="fas fa-plus"></span></button>
            </div>
            <div class="micro2 mini2">                
                <button id="zcwn_btn_remove_og_ilustration" data-selectfld="zcwn_btn_og_ilustration_fld" ><span class="fas fa-trash"></span></button>
            </div>                
        </div>
        
            <input  type="hidden" id="zcwn_hidden_action" name="action" value="{{$settings['action'] ?? null}}" placeholder=" ">
            <input  type="hidden" id="zcwn_hidden_token" name="token" value="{{$data->token  ?? null}}" placeholder=" ">
            <input  type="hidden" id="zcwn_hidden_parent" name="parent" value="{{$data->parent ?? null}}" placeholder=" ">
            <input  type="hidden" id="zcwn_hidden_position" name="position" value="{{$data->position ?? $settings['position'] ?? null}}" placeholder=" ">
            <input  type="hidden" name="link_override" value="{{$data->link_override ?? null}}" placeholder=" ">
            @if($settings['action']=='update')
                <input  type="hidden" name="link_old" value="{{$data->link ?? null}}" placeholder=" ">
                <input  type="hidden" name="link_override_old" value="{{$data->link_override ?? null}}" placeholder=" ">
            @endif
        
        <div class="msg"></div>
        <button id="btn_save">{{$settings['btnsave']}}</button>
    </form>
    {{-- <pre> --}}
        {{-- {{print_r(($data['tree'] ?? null), true)}} --}}
       {{-- parentdata:<br /> {{print_r(($data['parentdata'] ?? null), true) }} --}}
    {{-- </pre> --}}
@endsection