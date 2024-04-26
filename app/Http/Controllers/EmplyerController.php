<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmplyerRequest;
use App\Http\Requests\UpdateEmplyerRequest;
use App\Models\Emplyee;
use App\Models\Emplyer;
use App\Services\Implementations\ReportEmployeeService;

class EmplyerController extends Controller
{
   public function __construct(protected ReportEmployeeService $service){

   }

   public function reportEmployee(Emplyee $employee){
       return $this->service->reportEmployee($employee);
   }

}
