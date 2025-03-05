@extends('layouts.main')
@section('content')
    <div>
        <h1>Administrator</h1>
    </div>
    <div>
        <tr>
            <td>{{ $admin->first_name }}</td>
            <td>{{ $admin->last_name }}</td>
        </tr>
        <div>{{ $admin->pesel }}</div>
    </div>
    <br>
    @if (Auth::user()->hasRole('superadmin'))
        <a href="{{ route('admin.administrator.edit', $admin->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
        <a href="{{ route('admin.administrator.create') }}" class="btn btn-sm btn-outline-secondary">Create</a>
        <form action="{{ route('admin.administrator.destroy', $admin->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
        </form>
    @endif
@endsection('content')
