@extends('layouts.main')
@section('content')
    <tr>
        <td>{{ $doctor->first_name }}</td>
        <td>{{ $doctor->last_name }}</td>
        <td>{{ $doctorBook->speciality }}</td>
    </tr>
@endsection('content')
