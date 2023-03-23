<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Project extends Model
{
    use HasFactory;
    use LogsActivity;    

    protected $fillable = [
        'name',        
    ];  

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }          
    
    public function users()
    {
        return $this->hasMany(User::class, 'project_users');
    }      

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }        


}
