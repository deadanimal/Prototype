<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Meeting extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $fillable = [
        'title',        
        'project_id',
        'meeting_type',
        'meeting_date',
        'start_time',
        'end_time',
        'remarks',
        'status',
        'user_id',
    ];  

    public function project()
    {
        return $this->belongsTo(Project::class);
    } 

    public function user()
    {
        return $this->belongsTo(User::class);
    }     
        
    
    public function meeting_items()
    {
        return $this->hasMany(MeetingItem::class);
    } 
    
    public function meeting_attendees()
    {
        return $this->hasMany(MeetingAttendee::class);
    }      


}
