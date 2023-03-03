<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTestflowItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'remarks', 
        'project_testflow_id',
        'user_id',
    ];          
}
