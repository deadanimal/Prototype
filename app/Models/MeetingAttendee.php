<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MeetingAttendee extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [ 
        'name',
        'email',
        'user_id',
        'meeting_id',
    ];     
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }      
}
