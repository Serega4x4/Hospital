@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Edit Doctor</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.doctor.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $doctor->first_name) }}" class="form-control" required>
                @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $doctor->last_name) }}" class="form-control" required>
                @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $doctor->email) }}" class="form-control" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="speciality">Speciality</label>
                <input type="text" name="speciality" id="speciality" value="{{ old('speciality', $doctorSpec->speciality) }}" class="form-control" required>
                @error('speciality')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="appointment_duration">Appointment Duration (minutes)</label>
                <input type="number" name="appointment_duration" id="appointment_duration" value="{{ old('appointment_duration', $doctorSpec->appointment_duration) }}" class="form-control" min="5" max="60">
                @error('appointment_duration')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <h3>Opening Hours</h3>
            @foreach ($days as $day)
                <div class="form-group">
                    <label>{{ ucfirst($day) }}</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="hours[{{ $day }}][]" value="{{ old("hours.$day.0", $openingHour->hours[$day][0] ?? '') }}" class="form-control" placeholder="e.g. 08:00-12:00">
                            @error("hours.$day.0")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="text" name="hours[{{ $day }}][]" value="{{ old("hours.$day.1", $openingHour->hours[$day][1] ?? '') }}" class="form-control" placeholder="e.g. 13:00-17:00">
                            @error("hours.$day.1")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="form-group">
                <label for="pesel">PESEL</label>
                <input type="text" name="pesel" id="pesel" value="{{ old('pesel', $doctor->pesel) }}" class="form-control" required>
                @error('pesel')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-sm btn-outline-secondary">Update Doctor</button>
        </form>
    </div>
@endsection