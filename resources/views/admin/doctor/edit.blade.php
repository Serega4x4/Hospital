@extends('layouts.main')
@section('content')
    <div>
        <h1>Edit Doctor</h1>
        <form action="{{ route('admin.doctor.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ $doctor->first_name }}" required>
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ $doctor->last_name }}" required>
            </div>

            <div>
                <label for="speciality">Speciality</label>
                <input type="text" name="speciality" id="speciality" value="{{ $doctorSpec->speciality }}" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ $doctor->email }}" required>
            </div>
            <div>
                <label for="pesel">PESEL</label>
                <input type="text" name="pesel" id="pesel" value="{{ $doctor->pesel }}" required>
            </div>
            <div>
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit">Update Doctor</button>
        </form>
    </div>
</body>
@endsection('content')
