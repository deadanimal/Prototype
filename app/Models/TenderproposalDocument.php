<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderproposalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'attachment', 

        'tenderproposal_id',
        'user_id',
    ];     
}
