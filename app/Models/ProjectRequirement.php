<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'remarks', 
        'requirement_category',
        'requirement_type',
        'project_id',
        'user_id',
    ];  

    public function project()
    {
        return $this->belongsTo(Project::class);
    }        
}
