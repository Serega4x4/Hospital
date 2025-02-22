<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $patient->first_name }} {{ $patient->last_name }}</title>
</head>

<body>
    <a href="{{ route('hospital') }}">HOSPITAL</a>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('logout') }}">Logout</a>
    
    <div>
        <h1>Patient</h1>
    </div>

    <div>
        <tr>
            <td>{{ $patient->first_name }}</td>
            <td>{{ $patient->last_name }}</td>
            <div>{{ $date }}</div>            
            <div>PESEL - {{ $patient->pesel }}</div>
            <div>{{ $patientMHA->address }}</div>
            <div>{{ $patientMHA->medical_history }}</div>
        </tr>
    </div>
    <br>

    @if (Auth::user()->hasRole('superadmin|admin'))
        <a href="{{ route('admin.patient.edit', $patient->id) }}">edit</a>
        <a href="{{ route('admin.patient.create') }}">Create</a>
        <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
    @endif

</body>

</html>
