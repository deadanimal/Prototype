<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Organisation extends Model
{
    use HasFactory;
    use LogsActivity;    

    protected $fillable = [
        'name',        
        'shortname',        
    ];      

    public function projects()
    {
        return $this->hasMany(Project::class);
    }   
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }        
}
