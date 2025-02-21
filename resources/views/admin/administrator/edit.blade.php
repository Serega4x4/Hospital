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
        <h1>Edit Administrator</h1>
        <form action="{{ route('admin.administrator.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ $admin->first_name }}" required>
            </div>
            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ $admin->last_name }}" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ $admin->email }}" required>
            </div>
            <div>
                <label for="pesel">PESEL</label>
                <input type="text" name="pesel" id="pesel" value="{{ $admin->pesel }}" required>
            </div>
            <div>
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit">Update Administrator</button>
        </form>
    </div>
</body>

</html>
