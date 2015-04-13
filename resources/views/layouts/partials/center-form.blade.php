<div class="row center-form">
	{!! Form::open(['route' => $path, 'class' => $formType]) !!}
		<div class="form-group">
			{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => $placeholder]) !!}
		</div>
		<div class="form-group center-form-submit">
			{!! Form::submit($button, ['class' => 'btn btn-primary btn-xs']) !!}
		</div>	
	{!! Form::close() !!}
</div>