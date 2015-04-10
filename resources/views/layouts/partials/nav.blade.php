<!-- Navbar -->
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand"><a href="/">Larasocial</a></div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


          {!! Form::open(['route' => 'registration_path', 'class'=>'navbar-form navbar-right']) !!}       
            <div class="form-group">
              {!! Form::email('email', null, ['class' => 'form-control login-form', 'placeholder' => 'Email', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
              {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required']) !!}
            </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> Sign in</button>
          {!! Form::close() !!}
          



    </div>
</nav>
<!-- Navbar -->