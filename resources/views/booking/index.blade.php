@extends('layouts.main')
@section('content')
    @foreach ($doctors as $doctor)
        <tr>
            <td>{{ $doctor->first_name }}</td>
            <td>{{ $doctor->last_name }}</td>
        </tr>
        <div>{{ $doctor->doctor->speciality }}</div>
        <a href="{{ route('booking.create', $doctor->id) }}">Chose</a>
    @endforeach
@endsection('content')
