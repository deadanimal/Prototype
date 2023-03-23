<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ProjectTestcase extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name', 
        'remarks', 
        'category',
        'attachment',
        'project_requirement_id',
        'project_id',
        'user_id',
    ];     

    public function executions()
    {
        return $this->hasMany(ProjectTestcaseExecution::class,);
    }      
}
