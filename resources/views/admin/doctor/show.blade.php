@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Doctor Details</h2>
        <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <td>{{ $doctor->first_name }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ $doctor->last_name }}</td>
            </tr>
            <tr>
                <th>Speciality</th>
                <td>{{ $doctorSpec->speciality }}</td>
            </tr>
            <tr>
                <th>Appointment Duration</th>
                <td>{{ $doctorSpec->appointment_duration }} minutes</td>
            </tr>
        </table>

        <h3>Opening Hours</h3>
        @if ($openingHour && $openingHour->hours)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Hours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                        <tr>
                            <td>{{ ucfirst($day) }}</td>
                            <td>
                                @if (!empty($openingHour->hours[$day]))
                                    {{ implode(', ', $openingHour->hours[$day]) }}
                                @else
                                    Closed
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No opening hours defined for this doctor.</p>
        @endif

        @if (Auth::user()->hasRole('superadmin|admin'))
            <div class="mt-3">
                <a href="{{ route('admin.doctor.edit', $doctor->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <a href="{{ route('admin.doctor.create') }}" class="btn btn-sm btn-outline-secondary">Create</a>
                <form action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Are you sure you want to delete this doctor?');">Delete</button>
                </form>
            </div>
        @endif
    </div>
@endsection('content')
