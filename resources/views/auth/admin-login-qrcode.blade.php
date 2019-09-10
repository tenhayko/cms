<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin Login</title>
        <base href="{{asset('')}}">
        <!-- Styles -->
    </head>

   <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Admin</b></a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div class="row">
        	<div class="col-xs-12 text-center">
        		<img src="{{ $QrUrl }}" alt="">
        	</div>
        </div>
        <form class="form-horizontal" method="POST" action="{{ route('admin.qrcode') }}">
            {{ csrf_field() }}
          <div class="has-feedback form-group">
            <input id="secret" type="text" class="form-control" name="secret" value="" required autofocus placeholder="secret" autocomplete="off">
            <input type="hidden" value="{{ $email }}" name="email">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
           <div class="has-feedback form-group">
               <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
		   </div>
        </form>

        <!-- /.social-auth-links -->
      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    </body>

</html>
