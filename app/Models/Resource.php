<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Resource extends Model
{
    use HasFactory;
    use LogsActivity;

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
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }    
}
