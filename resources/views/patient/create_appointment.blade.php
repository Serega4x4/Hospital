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
        <div class="form-group mb-3">
            <label for="doctor_id">Выберите врача:</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                <option value="">-- Выберите врача --</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->user->first_name }} {{ $doctor->user->last_name }}
                        ({{ $doctor->speciality }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="available_slots">Выберите дату и время:</label>
            <select name="start_time" id="available_slots" class="form-control" required>
                <option value="">Сначала выберите врача</option>
            </select>
            <small class="form-text text-muted" id="selectedDateTime"></small>
        </div>

        <button type="submit" class="btn btn-primary">Создать запись</button>
    </form>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const doctorSelect = document.getElementById('doctor_id');
            const slotsSelect = document.getElementById('available_slots');
            const dateTimeDisplay = document.getElementById('selectedDateTime');

            doctorSelect.addEventListener('change', function() {
                const doctorId = this.value;
                slotsSelect.innerHTML = '<option value="">Загрузка...</option>';

                if (!doctorId) {
                    slotsSelect.innerHTML = '<option value="">Сначала выберите врача</option>';
                    dateTimeDisplay.textContent = '';
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
                        slotsSelect.innerHTML = '<option value="">Выберите время</option>';
                        if (slots.length === 0) {
                            slotsSelect.innerHTML = '<option value="">Нет доступного времени</option>';
                        } else {
                            slots.forEach(slot => {
                                const option = document.createElement('option');
                                option.value = slot.datetime;
                                option.text = `${slot.date} ${slot.time}`;
                                slotsSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching available slots:', error);
                        slotsSelect.innerHTML = '<option value="">Ошибка загрузки доступного времени</option>';
                    });
            });

            slotsSelect.addEventListener('change', function() {
                if (this.value) {
                    dateTimeDisplay.textContent = `Выбрано: ${new Date(this.value).toLocaleString()}`;
                } else {
                    dateTimeDisplay.textContent = '';
                }
            });

            // Инициализация при загрузке страницы
            if (!doctorSelect.value) {
                slotsSelect.innerHTML = '<option value="">Сначала выберите врача</option>';
            }
        });
    </script>

@endsection