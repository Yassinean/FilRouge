<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title' => 'required|min:5|max:50',
        'category_id' => 'required',
        'jobType' => 'required',
        'vacancy' => 'required',
        'location' => 'required|max:70',
        'description' => 'required',
        'company_name' => 'required|min:3|max:50',
        'experiences' => 'required',
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
