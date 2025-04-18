<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Workpackage extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'package_type',
        'package_level',
        'estimate_delivery',
        'user_id',
        'reviewer_id',
        'coordinator_id',
        'remarks'
    ];     

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    } 
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }     
    
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }     
    
    public function reviewer()
    {
        return $this->belongsTo(Resource::class, 'reviewer_id');
    }    
    
    public function workpackage_reviews()
    {
        return $this->hasMany(WorkpackageReview::class);
    }     

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }        
 
}
