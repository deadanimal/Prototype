<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ProjectIssue extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name', 
        'status', 
        'remarks', 
        'category',
        'project_id',
        'user_id',
    ];  

    public function project()
    {
        return $this->belongsTo(Project::class);
    }    
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }        
}
