<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
    use HasFactory;

    protected $fillable = [   
        'message',
        'category',
        'old',
        'new',        
        'user_id',
    ];      

    public function user()
    {
        return $this->belongsTo(User::class);
    }       
}
