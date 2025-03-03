@extends('layouts.main')
@section('content')
    <div>
        <h1>Edit patient</h1>
        <form action="{{ route('admin.patient.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ $patient->first_name }}" required>
                @error('first_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ $patient->last_name }}" required>
                @error('last_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="birthday">Birthday</label>
                <input type="date" name="birthday" id="birthday" value="{{ $patientHMA->birthday }}" required>
                @error('birthday')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ $patientHMA->address }}" required>
                @error('first_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="medical_history">Medical History</label>
                <input type="text" name="medical_history" id="medical_history"
                    value="{{ $patientHMA->medical_history }}" required>
                @error('medical_history')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ $patient->email }}" required>
                @error('first_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="pesel">PESEL</label>
                <input type="text" name="pesel" id="pesel" value="{{ $patient->pesel }}" required>
                @error('first_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password">
                @error('first_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Update patient</button>

        </form>
    </div>
@endsection('content')
