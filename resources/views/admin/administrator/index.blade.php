@extends('layouts.main')
@section('content')
    @foreach ($admins as $admin)
        <div>
            <tr>
                <td>{{ $admin->first_name }}</td>
                <td>{{ $admin->last_name }}</td>
            </tr>
            <div>{{ $admin->pesel }}</div>
            <a href="{{ route('admin.administrator.show', $admin->id) }}">show</a>
            @if (Auth::user()->hasRole('superadmin'))
                <a href="{{ route('admin.administrator.edit', $admin->id) }}">edit</a>
                <form action="{{ route('admin.administrator.destroy', $admin->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">DELETE</button>
                </form>
            @endif
        </div>
        <br>
    @endforeach
    @if (Auth::user()->hasRole('superadmin'))
        <a href="{{ route('admin.administrator.create') }}">Create</a>
    @endif
@endsection('content')
