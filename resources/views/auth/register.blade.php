<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="first_name">First Name</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>
            @if ($errors->has('first_name'))
                <div>{{ $errors->first('first_name') }}</div>
            @endif
        </div>

        <div>
            <label for="last_name">Last Name</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required>
            @if ($errors->has('last_name'))
                <div>{{ $errors->first('last_name') }}</div>
            @endif
        </div>

         <div>
            <label for="birthday">Date of Birth</label>
            <input id="birthday" type="date" name="birthday" value="{{ old('birthday') }}" required>
            @if ($errors->has('birthday'))
                <div>{{ $errors->first('birthday') }}</div>
            @endif
        </div>

        <div>
            <label for="pesel">PESEL</label>
            <input id="pesel" type="text" name="pesel" value="{{ old('pesel') }}" required>
            @if ($errors->has('pesel'))
                <div>{{ $errors->first('pesel') }}</div>
            @endif
        </div>

        <div>
            <label for="address">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" required>
            @if ($errors->has('address'))
            <div>{{ $errors->first('address') }}</div>
        @endif
        </div>

        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <div>{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @if ($errors->has('password'))
                <div>{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
            @if ($errors->has('password_confirmation'))
                <div>{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <div>
            <a href="{{ route('login') }}">Already registered?</a>
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>