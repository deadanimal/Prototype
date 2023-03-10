<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message', 

        'ticket_id',
        'user_id',
    ];    
    
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }         
}
