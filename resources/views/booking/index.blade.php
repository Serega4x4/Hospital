@extends('layouts.main')
@section('content')
    <h3>Choose Doctor</h3>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Speciality</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->user->first_name }}</td>
                        <td>{{ $doctor->user->last_name }}</td>
                        <td>{{ $doctor->speciality }}</td>
                        <td><a href="{{ route('booking.create', $doctor->id) }}" class="btn btn-sm btn-outline-secondary">Book</a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <h3>Your Appointments</h3>
    @if ($appointments->isEmpty())
        <p>You have no appointments yet.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Doctor</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}
                            </td>
                            <td>{{ $appointment->appointment_date->format('Y-m-d H:i') }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td><a href="{{ route('booking.show', $appointment->id) }}" class="btn btn-sm btn-outline-secondary">Show</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endif
@endsection('content')
