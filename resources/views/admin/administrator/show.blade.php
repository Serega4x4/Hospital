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
        <a href="{{ route('admin.administrator.edit', $admin->id) }}">edit</a>
        <a href="{{ route('admin.administrator.create') }}">Create</a>
        <form action="{{ route('admin.administrator.destroy', $admin->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
    @endif
@endsection('content')
