@extends('layouts.main')
@section('content')
    <main>
        <p>Wellcome to our Hospital</p>
        
        @role('patient')
        <a href="{{ route('patient.index') }}" class="btn btn-sm btn-outline-secondary">Doctors</a>
        <a href="{{ route ('patient.create_appointment') }}" class="btn btn-sm btn-outline-secondary">Appointment</a>
        @endrole

    </main>
@endsection('content')
