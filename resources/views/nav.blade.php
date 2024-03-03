<a href="{{ route('home') }}">Home</a> -

@if(Auth::guard('web')->user())
<a href="{{ route('dashboard_user') }}">Dashboard</a> - 
<a href="{{ route('settings') }}">Settings</a> - 
<a href="{{ route('logout') }}">Logout</a>
@endif

@if(!Auth::guard('web')->user())
<a href="{{ route('login') }}">Login</a> - 
<a href="{{ route('registration') }}">Registration</a> - 
@endif