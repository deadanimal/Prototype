<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTestflow extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'remarks', 
        'testflow_category',
        'testflow_type',
        'project_id',
        'user_id',
    ];      
}
