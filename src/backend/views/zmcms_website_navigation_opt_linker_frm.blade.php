<div class="linker_frm">
	<header>
		@foreach($positions as $p)
		<a id="{{$loop->iteration}}" 
			data-token="{{$obj['token']}}" 
			data-objslug="{{$obj['objslug']}}" 
			data-objecttype="{{$obj['objectType']}}" 
			data-positiontoken="{{$p->token}}" 




			href="#">
			{{$p->name}}
		</a>
		@endforeach
	</header>
	<content>
		
	</content>
</div>
