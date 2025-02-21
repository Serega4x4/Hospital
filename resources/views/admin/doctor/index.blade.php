<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Doctors</title>
</head>

<body>
    <a href="{{ route('hospital') }}">HOSPITAL</a>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('logout') }}">Logout</a>
    @foreach ($doctors as $doctor)
        <div>
            <tr>
                <td>{{ $doctor->first_name }}</td>
                <td>{{ $doctor->last_name }}</td>
            </tr>
            <div>{{ $doctor->doctor->speciality }}</div>
            <a href="{{ route('admin.doctor.show', $doctor->id) }}">show</a>
            @if (Auth::user()->hasRole('superadmin|admin'))
                <a href="{{ route('admin.doctor.edit', $doctor->id) }}">edit</a>
                <form action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">DELETE</button>
                </form>
            @endif
        </div>
        <br>
    @endforeach
    @if (Auth::user()->hasRole('superadmin|admin'))
        <a href="{{ route('admin.doctor.create') }}">Create</a>
    @endif
</body>

</html>
