<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitab extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',        
        'category',
        'remarks',
        'status',
        'user_id',
    ];  

    public function user()
    {
        return $this->belongsTo(User::class);
    }     
}
