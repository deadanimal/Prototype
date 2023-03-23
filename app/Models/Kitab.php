<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\LogOptions;

class Kitab extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'title',        
        'category',
        'privacy',
        'remarks',
        'status',
        'user_id',
    ];  

    public function user()
    {
        return $this->belongsTo(User::class);
    }     
}
