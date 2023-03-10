<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category', 
        'status', 

        'organisation_id',
        'user_id',
    ];    
    
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }       
}
