@extends('layouts.main')
@section('content')
    @foreach ($doctors as $doctor)
        <div>
            
            <tr>
                <td>{{ $doctor->first_name }}</td>
                <td>{{ $doctor->last_name }}</td>
            </tr>
            <div>{{ $doctor->doctor->speciality }}</div>

        </div>
        <br>
    @endforeach

    <a href="{{ route('patient.show_appointment') }}" class="btn btn-sm btn-outline-secondary">Show Appointment</a>

@endsection('content')
