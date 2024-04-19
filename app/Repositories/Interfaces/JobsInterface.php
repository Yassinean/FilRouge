<?php
namespace App\Repositories\Interfaces;
use App\Models\Job;
use App\Models\User;

interface JobsInterface {

    public function all();
    public function updateStatus(Job $job);
    public function updateStatusUser(User $user);

    public function updateStatusFeaturedJob(Job $job);

}
