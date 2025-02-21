<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
</head>

<body>
    <a href="{{ route('hospital') }}">HOSPITAL</a>
    <div>
        <h1>Create Doctor</h1>
        <form action="{{ route('admin.doctor.store') }}" method="POST">
            @csrf

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" required>
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" required>
            </div>

            <div>
                <label for="speciality">Speciality</label>
                <input type="text" name="speciality" id="speciality" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div>
                <label for="pesel">PESEL</label>
                <input type="text" name="pesel" id="pesel" required>
            </div>

            <div>
                <label for="address">Address</label>
                <input type="text" name="address" id="address">
            </div>

            <button type="submit">Create Doctor</button>

        </form>
    </div>
</body>

</html>
