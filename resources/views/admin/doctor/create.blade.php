@extends('layouts.main')
@section('content')
    <div>
        <h1>Create Doctor</h1>
        <form action="{{ route('admin.doctor.store') }}" method="POST">
            @csrf

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" required>
                @error('first_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" required>
                @error('last_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="speciality">Speciality</label>
                <input type="text" name="speciality" id="speciality" required>
                @error('speciality')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="appointment_duration">Appointment Duration (minutes)</label>
                <input type="number" name="appointment_duration" value="{{ old('appointment_duration', 15) }}" min="5" max="60">
            </div>
        
            <h3>Opening Hours</h3>
            @foreach ($days as $day)
                <div>
                    <label>{{ ucfirst($day) }}</label>
                    <input type="text" name="hours[{{ $day }}][]" value="{{ old("hours.$day.0", $defaultHours[$day][0] ?? '') }}" placeholder="e.g. 08:00-12:00">
                    <input type="text" name="hours[{{ $day }}][]" value="{{ old("hours.$day.1", $defaultHours[$day][1] ?? '') }}" placeholder="e.g. 13:00-17:00">
                </div>
            @endforeach

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="pesel">PESEL</label>
                <input type="text" name="pesel" id="pesel" required>
                @error('pesel')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="address">Address</label>
                <input type="text" name="address" id="address">
                @error('address')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Create Doctor</button>

        </form>
    </div>
@endsection('content')
