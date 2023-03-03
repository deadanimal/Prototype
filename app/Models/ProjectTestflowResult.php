<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTestflowResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'result',
        'remarks', 
        'project_testflow_id',
        'user_id',
    ];      
}
