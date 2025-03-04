@extends('layouts.main')
@section('content')
    <div>
        <tr>
            <td>{{ $doctor->first_name }}</td>
            <td>{{ $doctor->last_name }}</td>
            <div>{{ $doctorSpec->speciality }}</div>
        </tr>
        
    </div>
    <br>
    @if (Auth::user()->hasRole('superadmin|admin'))
        <a href="{{ route('admin.doctor.edit', $doctor->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
        <a href="{{ route('admin.doctor.create') }}" class="btn btn-sm btn-outline-secondary">Create</a>
        <form action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
        </form>
    @endif
@endsection('content')
