<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hospital</title>
</head>

<body>
    
    @if (Auth::user())
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <a href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
    </a>
    </form>


    <a href="{{ route('admin.administrator.index') }}">Administrators</a>
    <a href="{{ route('admin.doctor.index') }}">Doctors</a>

    @else
    <a href="{{ route('login') }}">Login</a>
    @endif
    <h1>Hospital</h1>

</body>

</html>
