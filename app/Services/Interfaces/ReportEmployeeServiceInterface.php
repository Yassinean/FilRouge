<?php

namespace App\Services\Interfaces;

use App\Models\Emplyee;

interface ReportEmployeeServiceInterface
{
        public function reportEmployee(Emplyee $employee);
}
