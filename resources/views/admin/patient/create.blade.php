@extends('layouts.main')
@section('content')
    <div>
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
                <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}" class="btn btn-sm btn-outline-secondary" required>
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

            <button type="submit" class="btn btn-sm btn-outline-primary">Create Patient</button>

        </form>
    </div>
@endsection('content')
