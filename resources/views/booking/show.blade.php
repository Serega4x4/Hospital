@extends('layouts.main')
@section('content')
    <h1>Appointment Details</h1>
    <table>
        <tr>
            <th>Doctor</th>
            <td>{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</td>
        </tr>
        <tr>
            <th>Patient</th>
            <td>{{ $appointment->patient->user->first_name }} {{ $appointment->patient->user->last_name }}</td>
        </tr>
        <tr>
            <th>Appointment Date</th>
            <td>{{ $appointment->appointment_date->format('Y-m-d H:i') }}</td>
        </tr>
        <tr>
            <th>Symptoms</th>
            <td>{{ $appointment->symptoms }}</td>
        </tr>
        <tr>
            <th>Notes</th>
            <td>{{ $appointment->notes }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $appointment->status }}</td>
        </tr>
    </table>
@endsection