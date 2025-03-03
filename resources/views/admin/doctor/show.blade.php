@extends('layouts.main')
@section('content')
    <div>
        <h1>doctor</h1>
    </div>
    <div>
        <tr>
            <td>{{ $doctor->first_name }}</td>
            <td>{{ $doctor->last_name }}</td>
            <div>{{ $doctorSpec->speciality }}</div>
        </tr>
        
    </div>
    <br>
    @if (Auth::user()->hasRole('superadmin|admin'))
        <a href="{{ route('admin.doctor.edit', $doctor->id) }}">edit</a>
        <a href="{{ route('admin.doctor.create') }}">Create</a>
        <form action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
    @endif
@endsection('content')
