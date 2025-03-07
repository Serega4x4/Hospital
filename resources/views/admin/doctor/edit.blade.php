@extends('layouts.main')
@section('content')
    <div>
        <h1>Edit Doctor</h1>
        <form action="{{ route('admin.doctor.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ $doctor->first_name }}" required>
                @error('first_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ $doctor->last_name }}" required>
                @error('last_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="speciality">Speciality</label>
                <input type="text" name="speciality" id="speciality" value="{{ $doctorSpec->speciality }}" required>
                @error('speciality')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="appointment_duration">Appointment Duration (minutes)</label>
                <input type="number" name="appointment_duration" value="{{ $doctorSpec->appointment_duration }}" min="5" max="60">
                @error('appointment_duration')
                    <div>{{ $message }}</div>
                @enderror
            </div>
        
            <h3>Opening Hours</h3>
            @foreach ($days as $day)
                <div>
                    <label>{{ ucfirst($day) }}</label>
                    <input type="text" name="hours[{{ $day }}][]" value="{{ $openingHour->hours[$day][0] ?? '' }}" placeholder="e.g. 08:00-12:00">
                    <input type="text" name="hours[{{ $day }}][]" value="{{ $openingHour->hours[$day][1] ?? '' }}" placeholder="e.g. 13:00-17:00">
                    @error('hours')
                    <div>{{ $message }}</div>
                @enderror
                </div>
            @endforeach

            <div>
                <label for="pesel">PESEL</label>
                <input type="text" name="pesel" id="pesel" value="{{ $doctor->pesel }}" required>
                @error('pesel')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-sm btn-outline-secondary">Update Doctor</button>
        </form>
    </div>
</body>
@endsection('content')
