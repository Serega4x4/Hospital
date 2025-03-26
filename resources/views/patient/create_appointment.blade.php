@extends('layouts.main')
@section('content')

    <h1>Appointment</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patient.store_appointment') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="doctor_id">Select a doctor:</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->user->first_name }} {{ $doctor->user->last_name }} ({{ $doctor->speciality }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">Date and time:</label>
            <input type="datetime-local" name="start_time" id="start_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Appointment</button>
    </form>
@endsection