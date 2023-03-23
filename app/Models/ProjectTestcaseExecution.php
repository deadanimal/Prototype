<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTestcaseExecution extends Model
{
    use HasFactory;
    protected $fillable = [
        'remarks', 
        'status',
        'attachment',
        'project_testcase_id',
        'user_id',
    ];      

    public function testcase()
    {
        return $this->belongsTo(ProjectTestcase::class, 'project_testcase_id');
    }     
    
    public function user()
    {
        return $this->belongsTo(User::class,);
    }       
}
