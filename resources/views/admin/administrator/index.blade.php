<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
</head>

<body>
    @foreach ($admins as $admin)
        <div>
            <tr>
                <td>{{ $admin->first_name }}</td>
                <td>{{ $admin->last_name }}</td>
            </tr>
            <div>{{ $admin->pesel }}</div>
        </div>
        <br>
    @endforeach
    @if(Auth::user()->hasRole('superadmin'))
    <a href="{{ route('admin.administrator.create') }}">Create</a>
    @endif
</body>

</html>
