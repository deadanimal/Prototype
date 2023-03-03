<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenderproposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'category', 
        'type', 

        'organisation_id',
        'user_id',
    ];    
    
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }     
}
