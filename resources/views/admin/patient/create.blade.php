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
        <h1>Create Patient</h1>
        <form action="{{ route('admin.patient.store') }}" method="POST">
            @csrf

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                @error('first_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                @error('last_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="birthday">Birthday</label>
                <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}" required>
                @error('birthday')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="pesel">PESEL</label>
                <input type="text" name="pesel" id="pesel" value="{{ old('first_name') }}" required>
                @error('pesel')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" required>
                @error('address')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="medical_history">Medical history</label>
                <input type="text" name="medical_history" id="medical_history" value="{{ old('medical_history') }}" required>
                @error('medical_history')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Create Patient</button>

        </form>
    </div>
</body>

</html>
