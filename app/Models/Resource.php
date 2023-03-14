<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [   
        'resource_type',        
        'status',   
        'currency',        
        'hourly_rate',        
        'user_id',
    ];      

    public function user()
    {
        return $this->belongsTo(User::class);
    }   
    
    public function workpackages()
    {
        return $this->hasMany(Workpackage::class);
    }             
}
