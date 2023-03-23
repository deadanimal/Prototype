<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MeetingItem extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'item',        
        'category',
        'meeting_id',
        'user_id',
    ];      

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }        
}
