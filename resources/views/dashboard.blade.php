<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
</head>

<body>
    @if (Auth::check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Log Out</button>
        </form>

        <a href="{{ route('admin.administrator.index') }}">Administrators</a>
        <a href="{{ route('admin.doctor.index') }}">Doctors</a>
        <a href="{{ route('admin.patient.index') }}">Patient</a>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endif

    <header>
        <h2>
            Dashboard
            <a href="{{ route('hospital') }}">HOSPITAL</a>
        </h2>
    </header>

    <main>
        <p>You're logged in!</p>
    </main>

</body>

</html>
