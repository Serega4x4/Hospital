<?php

namespace App\Http\Controllers\Patient;

use App\Models\Doctor;

class AvailableSlotsController extends BaseController
{
    public function __invoke(Doctor $doctor)
    {
        return $this->service->getAvailableSlots($doctor);
    }
}