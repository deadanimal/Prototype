<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mockup extends Model
{
    use HasFactory;

    protected $fillable = [
        'mockup_date',        
        'project_name',
        'client_name',
        'status',
        'trello_link',
        'user_id',
    ];       
}
