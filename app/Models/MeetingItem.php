<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',        
        'category',
    ];      

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }        
}
