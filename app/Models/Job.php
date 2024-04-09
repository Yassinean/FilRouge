<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public function typeJob(){
        return $this->belongsTo(TypeJob::class);
    }
    public function category() {
        return $this->belongsTo(CategoryJob::class);
    }

}
