<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkpackageReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'attachment',
        'remarks',
        'status',
        'workpackage_id',
        'resource_id',
    ];     

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }     
      
}
