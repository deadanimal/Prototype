<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenderproposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'category', 
        'tender_type', 

        'submission_date', 
        'briefing_date', 

        'submission_file',
        'remarks', 

        'organisation_id',
        'user_id',
    ];    
    
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }     
}
