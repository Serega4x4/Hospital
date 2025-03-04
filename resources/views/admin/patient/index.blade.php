@extends('layouts.main')
@section('content')
    @foreach ($patients as $patient)
        <div>
            <tr>
                <td>{{ $patient->first_name }}</td>
                <td>{{ $patient->last_name }}</td>
                <div>{{ $patient->pesel }}</div>
            </tr>
            <a href="{{ route('admin.patient.show', $patient->id) }}" class="btn btn-sm btn-outline-secondary">Show</a>
            @if (Auth::user()->hasRole('superadmin|admin'))
                <a href="{{ route('admin.patient.edit', $patient->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
                </form>
            @endif
        </div>
        <br>
    @endforeach
    @if (Auth::user()->hasRole('superadmin|admin'))
        <a href="{{ route('admin.patient.create') }}" class="btn btn-sm btn-outline-primary">Create</a>
    @endif
@endsection('content')
