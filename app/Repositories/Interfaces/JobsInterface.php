<?php
namespace App\Repositories\Interfaces;
use App\Models\Job;

interface JobsInterface {

    public function all();
    public function updateStatus(Job $job);


}
