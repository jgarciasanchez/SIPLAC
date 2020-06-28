@if(Session::has('info'))
	<div id="infoId" class="alert alert-info">
		{{ Session::get('info')}}
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
	</div>
@endif