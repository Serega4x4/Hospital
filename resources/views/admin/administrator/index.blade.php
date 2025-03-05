@extends('layouts.main')
@section('content')
    @foreach ($admins as $admin)
        <div>
            <tr>
                <td>{{ $admin->first_name }}</td>
                <td>{{ $admin->last_name }}</td>
            </tr>
            <div>{{ $admin->pesel }}</div>
            <a href="{{ route('admin.administrator.show', $admin->id) }}" class="btn btn-sm btn-outline-secondary">show</a>
            @if (Auth::user()->hasRole('superadmin'))
                <a href="{{ route('admin.administrator.edit', $admin->id) }}" class="btn btn-sm btn-outline-secondary">edit</a>
                <form action="{{ route('admin.administrator.destroy', $admin->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
                </form>
            @endif
        </div>
        <br>
    @endforeach
    @if (Auth::user()->hasRole('superadmin'))
        <a href="{{ route('admin.administrator.create') }}" class="btn btn-sm btn-outline-secondary">Create</a>
    @endif
@endsection('content')
