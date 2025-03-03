<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @if (Auth::check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Log Out</button>
        </form>
        <div>
            <a href="{{ route('profile.edit') }}">Profile</a>
            <a href="{{ route('hospital') }}">Hospital</a>
        </div>
        @role('admin|superadmin')
            <a href="{{ route('admin.administrator.index') }}">Administrators</a>
            <a href="{{ route('admin.doctor.index') }}">Doctors</a>
            <a href="{{ route('admin.patient.index') }}">Patient</a>
        @endrole
        
    @else
        <a href="{{ route('login') }}">Login</a>
    @endif


    @yield('content')

</body>

</html>
