<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplyee extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'educations',
        'certifications',
        'experiences',
        'cv',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
