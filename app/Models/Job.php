<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_job_id',
        'type_job_id',
        'user_id',
        'vacancy',
        'location',
        'description',
        'responsabitilies',
        'salary',
        'keywords',
        'qualifications',
        'experiences',
        'status',
        'isFeatured',
        'company_name',
        'company_location',
        'company_website',
    ];

    public function typeJob()
    {
        return $this->belongsTo(TypeJob::class);
    }

    public function categoryJob()
    {
        return $this->belongsTo(CategoryJob::class);
    }

    public function applications() {
        return $this->hasMany(JobApplication::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
