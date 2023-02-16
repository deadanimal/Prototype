<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',        
        'project_id',
        'meeting_type',
        'meeting_date',
        'status',
        'user_id',
    ];  
    
    public function meeting_items()
    {
        return $this->hasMany(MeetingItem::class);
    }      


}
