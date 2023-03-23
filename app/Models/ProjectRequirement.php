<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProjectRequirement extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name', 
        'module_name', 
        'remarks', 
        'category',
        'project_id',
        'user_id',
    ];  

    public function project()
    {
        return $this->belongsTo(Project::class);
    }        
}
