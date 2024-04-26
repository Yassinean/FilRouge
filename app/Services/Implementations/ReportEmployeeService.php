<?php

namespace App\Services\Implementations;


use App\Models\Emplyee;
use App\Repositories\Interfaces\ReportEmployeeInterface;
use App\Services\Interfaces\ReportEmployeeServiceInterface;
use Illuminate\Support\Facades\Auth;

class ReportEmployeeService implements ReportEmployeeServiceInterface
{

    public function __construct(protected ReportEmployeeInterface $repository)
    {

    }

    public function reportEmployee(Emplyee $employee)
    {
        return $this->repository->reportEmployee($employee);
    }
}
