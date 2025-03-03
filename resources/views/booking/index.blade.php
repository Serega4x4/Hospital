@extends('layouts.main')
@section('content')
<h1>Chose doctor</h1>
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
                        <a href="{{ route('booking.create', $doctor->id) }}">Booking</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection('content')
