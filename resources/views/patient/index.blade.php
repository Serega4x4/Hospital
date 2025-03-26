@extends('layouts.main')
@section('content')
    @foreach ($doctors as $doctor)
        <div>
            
            <tr>
                <td>{{ $doctor->first_name }}</td>
                <td>{{ $doctor->last_name }}</td>
            </tr>
            <div>{{ $doctor->doctor->speciality }}</div>
            <a href="{{ route('admin.doctor.show', $doctor->id) }}" class="btn btn-sm btn-outline-secondary">show</a>

        </div>
        <br>
    @endforeach

@endsection('content')
