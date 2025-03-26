@extends('layouts.main')
@section('content')
    <h1>My appointments</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($appointments->isEmpty())
        <p>You have no upcoming appointments.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Speciality</th>
                    <th>Start date and time</th>
                    <th>End date and time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</td>
                        <td>{{ $appointment->doctor->speciality }}</td>
                        <td>{{ $appointment->start_time }}</td>
                        <td>{{ $appointment->end_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('patient.create_appointment') }}" class="btn btn-primary">Create Appointment</a>
@endsection