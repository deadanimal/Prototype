<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Ticket extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'title',
        'category', 
        'status', 

        'organisation_id',
        'project_id',
        'user_id',
    ];    
    
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }   
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }  
    
    public function ticket_messages()
    {
        return $this->hasMany(TicketMessage::class);
    }           
}
