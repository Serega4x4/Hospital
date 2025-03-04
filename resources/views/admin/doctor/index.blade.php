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
            @if (Auth::user()->hasRole('superadmin|admin'))
                <a href="{{ route('admin.doctor.edit', $doctor->id) }}" class="btn btn-sm btn-outline-secondary">edit</a>
                <form action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
                </form>
            @endif
        </div>
        <br>
    @endforeach
    @if (Auth::user()->hasRole('superadmin|admin'))
        <a href="{{ route('admin.doctor.create') }}" class="btn btn-sm btn-outline-primary">Create</a>
    @endif
@endsection('content')
