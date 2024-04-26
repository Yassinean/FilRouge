<?php

namespace App\Repositories\Implementations;


use App\Models\Emplyee;
use App\Repositories\Interfaces\ReportEmployeeInterface;
use Illuminate\Support\Facades\Auth;

class ReportEmployeeRepository implements ReportEmployeeInterface
{
    public function reportEmployee(Emplyee $employee)
    {
        $employee->update(['reported' => !$employee->reported]);
        return redirect()->back()->with('success', 'Employee reported successfully.');
    }
}
