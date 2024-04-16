<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'jobType',
        'vacancy',
        'location',
        'description',
        'company_name',
        'experiences',
        'status',
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
