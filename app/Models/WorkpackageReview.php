<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkpackageReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'remarks',
        'workpackage_id',
        'user_id',
    ];     
}
