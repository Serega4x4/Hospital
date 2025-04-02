@extends('layouts.main')
@section('content')

    <h1>Appointment</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patient.store_appointment') }}" method="POST">
        @csrf
        <div class="form-group mb-3" style="max-width: 400px;">
            <label for="doctor_id">Choose a doctor:</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                <option value="">-- Choose a doctor --</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->user->first_name }} {{ $doctor->user->last_name }}
                        ({{ $doctor->speciality }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Выберите дату и время:</label>
            <div class="input-group" style="max-width: 400px;">
                <!-- Date selection -->
                <select id="available_dates" class="form-control rounded-start-pill" style="border-right: none;" disabled>
                    <option value="">Select a doctor first</option>
                </select>
                <!-- Time selection -->
                <select name="start_time" id="available_times" class="form-control rounded-end-pill" style="border-left: none;" disabled>
                    <option value="">First select a date</option>
                </select>
            </div>
            <input type="hidden" name="start_time" id="hidden_start_time" required>
            <small class="form-text text-muted" id="selectedDateTime"></small>
        </div>

        <button type="submit" class="btn btn-primary">Создать запись</button>
    </form>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const doctorSelect = document.getElementById('doctor_id');
            const datesSelect = document.getElementById('available_dates');
            const timesSelect = document.getElementById('available_times');
            const hiddenStartTime = document.getElementById('hidden_start_time');
            const dateTimeDisplay = document.getElementById('selectedDateTime');
            let allSlots = [];

            doctorSelect.addEventListener('change', function() {
                const doctorId = this.value;
                datesSelect.innerHTML = '<option value="">Loading...</option>';
                timesSelect.innerHTML = '<option value="">Waiting for date selection...</option>';
                datesSelect.disabled = true;
                timesSelect.disabled = true;
                dateTimeDisplay.textContent = '';

                if (!doctorId) {
                    datesSelect.innerHTML = '<option value="">Select a doctor first</option>';
                    timesSelect.innerHTML = '<option value="">First select a date</option>';
                    return;
                }

                fetch(`{{ url('/patient/doctor') }}/${doctorId}/available-slots`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(slots => {
                        allSlots = slots;
                        datesSelect.disabled = false;
                        if (slots.length === 0) {
                            datesSelect.innerHTML = '<option value="">No dates available</option>';
                            timesSelect.innerHTML = '<option value="">No time available</option>';
                        } else {
                            const uniqueDates = [...new Set(slots.map(slot => slot.date))];
                            datesSelect.innerHTML = '<option value="">Select date</option>';
                            uniqueDates.forEach(date => {
                                const option = document.createElement('option');
                                option.value = date;
                                const formattedDate = new Date(date).toLocaleDateString('ru-RU', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric'
                                });
                                option.text = formattedDate; // dd.MM.yyyy
                                datesSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching available slots:', error);
                        datesSelect.innerHTML = '<option value="">Error loading dates</option>';
                        timesSelect.innerHTML = '<option value="">Time loading error</option>';
                    });
            });

            datesSelect.addEventListener('change', function() {
                const selectedDate = this.value;
                timesSelect.innerHTML = '<option value="">Loading...</option>';
                timesSelect.disabled = false;
                dateTimeDisplay.textContent = '';
                hiddenStartTime.value = '';

                if (!selectedDate) {
                    timesSelect.innerHTML = '<option value="">First select a date</option>';
                    timesSelect.disabled = true;
                    return;
                }

                const availableTimes = allSlots.filter(slot => slot.date === selectedDate);
                if (availableTimes.length === 0) {
                    timesSelect.innerHTML = '<option value="">No time available</option>';
                } else {
                    timesSelect.innerHTML = '<option value="">Select time</option>';
                    availableTimes.forEach(slot => {
                        const option = document.createElement('option');
                        option.value = slot.datetime;
                        option.text = slot.time; // Already in hh:mm format from the service
                        timesSelect.appendChild(option);
                    });
                }
            });

            timesSelect.addEventListener('change', function() {
                if (this.value) {
                    hiddenStartTime.value = this.value;
                    const date = datesSelect.options[datesSelect.selectedIndex].text;
                    const time = this.options[this.selectedIndex].text;
                    dateTimeDisplay.textContent = `Selected: ${date} ${time}`;
                } else {
                    hiddenStartTime.value = '';
                    dateTimeDisplay.textContent = '';
                }
            });

            if (!doctorSelect.value) {
                datesSelect.innerHTML = '<option value="">Select a doctor first</option>';
                timesSelect.innerHTML = '<option value="">First select a date</option>';
            }
        });
    </script>

@endsection