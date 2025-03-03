@extends('layouts.main')
@section('content')
<h1>Booking to doctor</h1>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <tr>
            <td>{{ $doctor->user->first_name }}</td>
            <td>{{ $doctor->user->last_name }}</td>
        </tr>
    </table>

    <form action="{{ route('booking.store', $doctor->id) }}" method="POST">
        @csrf
        <div>
            <label for="time_slot_id">Chose your time:</label>
            <select name="time_slot_id" id="time_slot_id" required>
                @foreach($timeSlots as $timeSlot)
                    <option value="{{ $timeSlot->id }}">
                        {{ $timeSlot->start_time->format('Y-m-d H:i') }} - {{ $timeSlot->end_time->format('H:i') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="symptoms">Symptoms:</label>
            <textarea name="symptoms" id="symptoms" rows="3"></textarea>
        </div>
        <div>
            <label for="notes">Notes:</label>
            <textarea name="notes" id="notes" rows="3"></textarea>
        </div>
        <button type="submit">Booking</button>
    </form>
@endsection('content')
