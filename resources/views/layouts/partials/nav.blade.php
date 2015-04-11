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

    @if(Auth::check())

      <ul class="nav navbar-nav navbar-right">        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
          <img class="avatar small-avatar" src="{!! Auth::user()->profileimage !!}" alt="{!! Auth::user()->firstname !!}">
                    
          {!! Auth::user()->firstname !!} 
          <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          <li><a href="#">Home</a></li>
          <li><a href="#">Members</a></li>
          <li><a href="#">Friends</a></li>
          <li><a href="#">Friend Requests</a></li>
          <li><a href="#">Messages</a></li>             
          <li class="divider"></li>
          <li><a class="logout-link" href="http://localhost:8000/logout">Logout</a></li>
          </ul>
        </li>
      </ul>

      {!! Form::open(['route' => 'registration_path', 'class'=>'navbar-form navbar-right']) !!}
          <div class="form-group">
            {!! Form::text('firstname', null, array('class' => 'form-control', 'placeholder' => 'Find users by name...', 'required' => 'required')) !!}
          </div>                   
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
      {!! Form::close() !!}

   @else
      {!! Form::open(['route' => 'login_path', 'class'=>'navbar-form navbar-right']) !!}       
        <div class="form-group">
          {!! Form::email('email', null, ['class' => 'form-control login-form', 'placeholder' => 'Email', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
          {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required']) !!}
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> Sign in</button>
      {!! Form::close() !!}

   @endif
          



    </div>
</nav>
<!-- Navbar -->