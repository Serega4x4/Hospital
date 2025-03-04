@extends('layouts.main')
@section('content')
    <div>
        <tr>
            <td>{{ $patient->first_name }}</td>
            <td>{{ $patient->last_name }}</td>
            <div>{{ $date }}</div>            
            <div>PESEL - {{ $patient->pesel }}</div>
            <div>{{ $patientMHA->address }}</div>
            <div>{{ $patientMHA->medical_history }}</div>
        </tr>
    </div>
    <br>

    @if (Auth::user()->hasRole('superadmin|admin'))
        <a href="{{ route('admin.patient.edit', $patient->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
        <a href="{{ route('admin.patient.create') }}" class="btn btn-sm btn-outline-secondary">Create</a>
        <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
        </form>
    @endif
@endsection('content')
