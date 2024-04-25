<?php

namespace App\Repositories\Implementations;


use App\Models\Emplyee;
use App\Repositories\Interfaces\ReportEmployeeInterface;
use Illuminate\Support\Facades\Auth;

class ReportEmployeeRepository implements ReportEmployeeInterface
{
    public function reportEmployee($employeeReported)
    {
        $employeeReported->update(['reported' => !$employeeReported->reported]);
        return redirect()->back()->with('success', 'Employee reported successfully.');
    }
}
