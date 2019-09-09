<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        @if (!Auth::guest())
			<a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
			<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
			    {{ csrf_field() }}
			</form>
			<div id="editor"></div>
		@endif
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>