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
    @foreach ($admins as $admin)
        <div>
            <tr>
                <td>{{ $admin->first_name }}</td>
                <td>{{ $admin->last_name }}</td>
            </tr>
            <div>{{ $admin->pesel }}</div>
            <a href="{{ route('admin.administrator.show', $admin->id) }}">show</a>
            @if (Auth::user()->hasRole('superadmin'))
                <a href="{{ route('admin.administrator.edit', $admin->id) }}">edit</a>
                <form action="{{ route('admin.administrator.destroy', $admin->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">DELETE</button>
                </form>
            @endif
        </div>
        <br>
    @endforeach
    @if (Auth::user()->hasRole('superadmin'))
        <a href="{{ route('admin.administrator.create') }}">Create</a>
    @endif
</body>

</html>
