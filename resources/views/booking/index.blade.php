@extends('layouts.main')
@section('content')
    <h1>Choose Doctor</h1>
    <table border="1">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Speciality</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->user->first_name }}</td>
                    <td>{{ $doctor->user->last_name }}</td>
                    <td>{{ $doctor->speciality }}</td>
                    <td>
                        <a href="{{ route('booking.create', $doctor->id) }}">Book</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Your Appointments</h2>
    @if($appointments->isEmpty())
        <p>You have no appointments yet.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</td>
                        <td>{{ $appointment->appointment_date->format('Y-m-d H:i') }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>
                            <a href="{{ route('booking.show', $appointment->id) }}">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection