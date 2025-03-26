@extends('layouts.main')
@section('content')
    <main>
        <p>Wellcome to our Hospital</p>
        
        @auth
        <a href="{{ route('patient.index') }}" class="btn btn-sm btn-outline-secondary">Show doctors</a>
        @endauth

    </main>
@endsection('content')
