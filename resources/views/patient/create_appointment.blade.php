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
            <label>Выберите дату и время:</label>
            <div class="input-group" style="max-width: 400px;">
                <!-- Выбор даты -->
                <select id="available_dates" class="form-control rounded-start-pill" style="border-right: none;" disabled>
                    <option value="">Сначала выберите врача</option>
                </select>
                <!-- Выбор времени -->
                <select name="start_time" id="available_times" class="form-control rounded-end-pill" style="border-left: none;" disabled>
                    <option value="">Сначала выберите дату</option>
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

            // Загрузка доступных слотов при выборе врача
            doctorSelect.addEventListener('change', function() {
                const doctorId = this.value;
                datesSelect.innerHTML = '<option value="">Загрузка...</option>';
                timesSelect.innerHTML = '<option value="">Ожидание выбора даты...</option>';
                datesSelect.disabled = true;
                timesSelect.disabled = true;
                dateTimeDisplay.textContent = '';

                if (!doctorId) {
                    datesSelect.innerHTML = '<option value="">Сначала выберите врача</option>';
                    timesSelect.innerHTML = '<option value="">Сначала выберите дату</option>';
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
                            datesSelect.innerHTML = '<option value="">Нет доступных дат</option>';
                            timesSelect.innerHTML = '<option value="">Нет доступного времени</option>';
                        } else {
                            // Уникальные даты
                            const uniqueDates = [...new Set(slots.map(slot => slot.date))];
                            datesSelect.innerHTML = '<option value="">Выберите дату</option>';
                            uniqueDates.forEach(date => {
                                const option = document.createElement('option');
                                option.value = date;
                                option.text = new Date(date).toLocaleDateString();
                                datesSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching available slots:', error);
                        datesSelect.innerHTML = '<option value="">Ошибка загрузки дат</option>';
                        timesSelect.innerHTML = '<option value="">Ошибка загрузки времени</option>';
                    });
            });

            // Обновление времени при выборе даты
            datesSelect.addEventListener('change', function() {
                const selectedDate = this.value;
                timesSelect.innerHTML = '<option value="">Загрузка...</option>';
                timesSelect.disabled = false;
                dateTimeDisplay.textContent = '';
                hiddenStartTime.value = '';

                if (!selectedDate) {
                    timesSelect.innerHTML = '<option value="">Сначала выберите дату</option>';
                    timesSelect.disabled = true;
                    return;
                }

                const availableTimes = allSlots.filter(slot => slot.date === selectedDate);
                if (availableTimes.length === 0) {
                    timesSelect.innerHTML = '<option value="">Нет доступного времени</option>';
                } else {
                    timesSelect.innerHTML = '<option value="">Выберите время</option>';
                    availableTimes.forEach(slot => {
                        const option = document.createElement('option');
                        option.value = slot.datetime;
                        option.text = slot.time;
                        timesSelect.appendChild(option);
                    });
                }
            });

            // Обновление отображения и скрытого поля при выборе времени
            timesSelect.addEventListener('change', function() {
                if (this.value) {
                    hiddenStartTime.value = this.value;
                    dateTimeDisplay.textContent = `Выбрано: ${new Date(this.value).toLocaleString()}`;
                } else {
                    hiddenStartTime.value = '';
                    dateTimeDisplay.textContent = '';
                }
            });

            // Инициализация при загрузке страницы
            if (!doctorSelect.value) {
                datesSelect.innerHTML = '<option value="">Сначала выберите врача</option>';
                timesSelect.innerHTML = '<option value="">Сначала выберите дату</option>';
            }
        });
    </script>

@endsection