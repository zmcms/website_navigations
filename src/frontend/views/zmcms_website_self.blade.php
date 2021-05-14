@extends('themes.'.(Config('zmcms.frontend.theme_name') ?? 'zmcms').'.frontend.main')
@section('content')
	<header>
	<h1>{{$data['navigation']['data']->name}}</h1>	
	@if(isset((json_decode($data['navigation']['data']->images_resized, true)['ilustration'])))
	<img src="{{ (json_decode($data['navigation']['data']->images_resized, true)['ilustration']['1400']) }}" alt="{{$data['navigation']['data']->name}}">
	@endif
	@if(strlen($data['navigation']['data']->og_description)>3)
		<div class="og_description">{{$data['navigation']['data']->og_description}}</div>
	@endif
	</header>
	<content>
		{!! $data['navigation']['data']->content !!}
		@if(isset($data['opt_runs']) && is_array($data['opt_runs']) && count($data['opt_runs'])>0)
			@foreach($data['opt_runs'] as $r)
				{!! $r !!}
			@endforeach
		@endif
	</content>
@endsection