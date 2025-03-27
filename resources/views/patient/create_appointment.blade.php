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
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->user->first_name }} {{ $doctor->user->last_name }}
                        ({{ $doctor->speciality }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Выберите дату и время:</label>
            <div class="input-group" style="max-width: fit-content;">
                <!-- Календарь -->
                <div id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
                    <input type="hidden" 
                           name="date" 
                           id="selected_date" 
                           data-td-target="#datetimepicker1" 
                           required>
                    <button type="button" 
                            class="btn btn-outline-secondary rounded-start-pill" 
                            data-td-target="#datetimepicker1" 
                            data-td-toggle="datetimepicker">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-calendar" viewBox="0 0 16 16">
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 0-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                        </svg>
                    </button>
                </div>
                <!-- Часы -->
                <div id="timepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
                    <input type="hidden" 
                           name="time" 
                           id="selected_time" 
                           data-td-target="#timepicker1" 
                           required>
                    <button type="button" 
                            class="btn btn-outline-secondary rounded-end-pill" 
                            data-td-target="#timepicker1" 
                            data-td-toggle="datetimepicker">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 0 0 8 0a8 8 0 0 0 0 16zm0-1A7 7 0 1 1 8 1a7 7 0 0 1 0 14zM8 4a.5.5 0 0 0-.5.5v3h-3a.5.5 0 0 0 0 1h3.5a.5.5 0 0 0 .5-.5v-3A.5.5 0 0 0 8 4z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <input type="hidden" name="start_time" id="start_time" required>
            <small class="form-text text-muted" id="selectedDateTime"></small>
        </div>

        <button type="submit" class="btn btn-primary">Создать запись</button>
    </form>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Календарь
            const datePicker = new tempusDominus.TempusDominus(document.getElementById('datetimepicker1'), {
                display: {
                    components: {
                        calendar: true,
                        date: true,
                        month: true,
                        year: true,
                        decades: true,
                        clock: false
                    }
                },
                restrictions: {
                    minDate: new Date(),
                    daysOfWeekDisabled: [0, 6],
                },
                useCurrent: false,
                localization: {
                    format: 'dd.MM.yyyy',
                }
            });

            // Часы
            const timePicker = new tempusDominus.TempusDominus(document.getElementById('timepicker1'), {
                display: {
                    components: {
                        calendar: false,
                        date: false,
                        month: false,
                        year: false,
                        decades: false,
                        clock: true,
                        hours: true,
                        minutes: true,
                        seconds: false
                    }
                },
                stepping: 30, // Интервал 30 минут
                useCurrent: false,
                defaultDate: new Date(2023, 0, 1, 9, 0), // Устанавливаем начальное время 9:00
                localization: {
                    format: 'HH:mm',
                },
                restrictions: {
                    minDate: new Date(2023, 0, 1, 9, 0),  // Минимум 9:00
                    maxDate: new Date(2023, 0, 1, 17, 30), // Максимум 17:30
                }
            });

            // Обновление при выборе даты
            datePicker.subscribe(tempusDominus.Namespace.events.change, (e) => {
                const date = e.date;
                const time = document.getElementById('selected_time').value || '09:00';
                if (date) {
                    document.getElementById('selected_date').value = date.toISOString().split('T')[0];
                    updateFullDateTime(date.toISOString().split('T')[0], time);
                }
            });

            // Обновление при выборе времени
            timePicker.subscribe(tempusDominus.Namespace.events.change, (e) => {
                const time = e.date;
                const date = document.getElementById('selected_date').value;
                if (time) {
                    const timeString = `${time.getHours().toString().padStart(2, '0')}:${time.getMinutes().toString().padStart(2, '0')}`;
                    document.getElementById('selected_time').value = timeString;
                    if (date) {
                        updateFullDateTime(date, timeString);
                    } else {
                        document.getElementById('selectedDateTime').textContent = `Выбрано время: ${timeString}`;
                    }
                }
            });

            // Функция для объединения даты и времени
            function updateFullDateTime(date, time) {
                if (date && time) {
                    const fullDateTime = `${date} ${time}`;
                    document.getElementById('start_time').value = fullDateTime;
                    document.getElementById('selectedDateTime').textContent = 
                        `Выбрано: ${new Date(fullDateTime).toLocaleString()}`;
                } else if (date) {
                    document.getElementById('selectedDateTime').textContent = 
                        `Выбрано: ${new Date(date).toLocaleDateString()}`;
                } else if (time) {
                    document.getElementById('selectedDateTime').textContent = 
                        `Выбрано время: ${time}`;
                }
            }
        });
    </script>

@endsection