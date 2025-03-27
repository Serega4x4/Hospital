@extends('layouts.main')
@section('content')
    <h1>My appointments</h1>

    @if (session('success'))
        <div class="alert alert-success" style="max-width: 400px;">{{ session('success') }}</div>
    @endif

    @if ($appointments->isEmpty())
        <p style="max-width: 600px;">You have no upcoming appointments.</p>
    @else
        <div style="max-width: 600px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Speciality</th>
                        <th>Start</th>
                        <th>End</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</td>
                            <td>{{ $appointment->doctor->speciality }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('d.m.Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->end_time)->format('d.m.Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('patient.create_appointment') }}" class="btn btn-primary" style="max-width: 400px; width: 100%;">Create Appointment</a>
@endsection