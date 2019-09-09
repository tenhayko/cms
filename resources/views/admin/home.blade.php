@if (!Auth::guest())
	<a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
	<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
	    {{ csrf_field() }}
	</form>
@endif