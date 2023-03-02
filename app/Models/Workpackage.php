<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workpackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'package_type',
        'package_level',
        'estimate_delivery',
        'user_id',
        'coordinator_id'
    ];     

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }     
    
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }         
 
}
