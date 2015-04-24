@extends('layouts.default')

@section('content')
	
	<div class="row">
		<div id="registration-form" class="col-md-5">
			<div class="row">
				@if($errors->count())
						<div class="alert alert-danger" role="alert">
							<ul>
								@foreach($errors->all() as $error)
									<li>{!! $error!!}</li>
								@endforeach
							</ul>
						</div>
				@elseif(Session::has('error'))
						<div class="alert alert-danger" role="alert">
							<p><strong>We're sorry!  </strong>{!!  Session::get('error') !!}</p>
						</div>
				@endif			
			</div>
			<div class="row">
				{!!Form::open(['files' => 'true'])!!}
					<div class="form-group">
						{!!Form::label('firstname', 'First Name', ['class' => 'sr-only'])!!}
						{!!Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Enter first name'])!!}			
					</div>
					<div class="form-group">
						{!!Form::label('lastname', 'Last Name', ['class' => 'sr-only'])!!}
						{!!Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Enter last name'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('email', 'Email', ['class' => 'sr-only'])!!}
						{!!Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('password', 'Password', ['class' => 'sr-only'])!!}
						{!!Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter password'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('password_confirmation', 'Confirm Password', ['class' => 'sr-only'])!!}
						{!!Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm password'])!!}
					</div>
					<p><strong>Gender:</strong></p>
					<label class="radio-inline">
						{!!Form::radio('gender', 'F', false, ['id' => 'gender'])!!}Female
					</label>
					<label class="radio-inline">
						{!!Form::radio('gender', 'M', false, ['id' => 'gender'])!!}Male
					</label>
					<br>
					<p><strong>Birthday:</strong></p>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group">
							<div class="input-group-addon">Month</div>
				        	{!!Form::select('month', [
							        		'01' => '1', 
							        		'02' => '2',
							        		'03' => '3', 
							        		'04' => '4',
							        		'05' => '5', 
							        		'06' => '6',
							        		'07' => '7', 
							        		'08' => '8',
							        		'09' => '9', 
							        		'10' => '10',
							        		'11' => '11', 
							        		'12' => '12'], 01, ['class' => 'form-control', 'id' => 'month'])!!}								        				        
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<div class="input-group-addon">Day</div>
				        	{!! Form::select('day', [
								        		'01' => '1', 
								        		'02' => '2',
								        		'03' => '3', 
								        		'04' => '4',
								        		'05' => '5', 
								        		'06' => '6',
								        		'07' => '7', 
								        		'08' => '8',
								        		'09' => '9', 
								        		'10' => '10',
								        		'11' => '11', 
								        		'12' => '12',
								        		'13' => '13', 
								        		'14' => '14',
								        		'15' => '15', 
								        		'16' => '16',
								        		'17' => '17', 
								        		'18' => '18',
								        		'19' => '19', 
								        		'20' => '20',
								        		'21' => '21', 
								        		'22' => '22',
								        		'23' => '23', 
								        		'24' => '24',
								        		'25' => '25', 
								        		'26' => '26',
								        		'27' => '27', 
								        		'28' => '28',
								        		'29' => '29', 
								        		'30' => '30',
								        		'31' => '31'
								       ], 01, ['class' => 'form-control', 'id' => 'day']) !!}								        				        
						</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								{!!Form::label('year', null, ['class' => 'sr-only'])!!}
							    <div class="input-group">
							      	<div class="input-group-addon">Year</div>
							       {!!Form::text('year', null, ['class' => 'form-control', 'placeholder' => 'Year'])!!}					     
							    </div>		        
					        </div>
						</div>

				</div>
			  	<div class="form-group">
				  	{!!Form::label('profileimage', 'Profile image')!!}
					{!!Form::file('profileimage')!!}			    
				    <p class="help-block">Please select an image.</p>
			  	</div>
			  	{!!Form::submit('Submit', ['class' => 'btn btn-primary form-control'])!!}

				{!! Form::close() !!}

	</div>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-6">
			<div id="main-title" class="row text-center">
				<h1>Larasocial</h2>
				<h2>A social network app built with Laravel 5.0</h3>
				<a href="#"><i class="fa fa-github fa-3x"></i></a>						
				<img src="/images/larasocial-main.png" class="img-responsive" alt="Larasocial image">				
			</div>			
		</div>
	</div>



@stop