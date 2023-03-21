<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTestcase extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'remarks', 
        'category',
        'attachment',
        'project_requirement_id',
        'project_id',
        'user_id',
    ];     
}
