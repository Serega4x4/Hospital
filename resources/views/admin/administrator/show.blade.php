<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
</head>

<body>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('logout') }}">Logout</a>
    <div>
        <h1>Administrator</h1>
    </div>
    <div>
        <tr>
            <td>{{ $admin->first_name }}</td>
            <td>{{ $admin->last_name }}</td>
        </tr>
        <div>{{ $admin->pesel }}</div>
    </div>
    <br>
    @if (Auth::user()->hasRole('superadmin'))
        <a href="{{ route('admin.administrator.edit', $admin->id) }}">edit</a>
        <a href="{{ route('admin.administrator.create') }}">Create</a>
        <form action="{{ route('admin.administrator.destroy', $admin->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
    @endif
</body>

</html>
