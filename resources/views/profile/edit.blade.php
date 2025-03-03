<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    @if (Auth::check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Log Out</button>
        </form>

        @role('admin|superadmin')
        <a href="{{ route('admin.administrator.index') }}">Administrators</a>
        <a href="{{ route('admin.doctor.index') }}">Doctors</a>
        <a href="{{ route('admin.patient.index') }}">Patient</a>
        @endrole
    @else
        <a href="{{ route('login') }}">Login</a>
    @endif
    <div>
        <div>
            <div>
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div>
            <div>
                <div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <div>
            <div>
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</body>
</html>