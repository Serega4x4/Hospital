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
        <a href="{{ route('admin.patient.edit', $patient->id) }}">edit</a>
        <a href="{{ route('admin.patient.create') }}">Create</a>
        <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
    @endif
@endsection('content')
