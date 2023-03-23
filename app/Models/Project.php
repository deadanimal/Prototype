<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use HasFactory;
    use LogsActivity;    

    protected $fillable = [
        'name',        
    ];  

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }          
    
    public function users()
    {
        return $this->hasMany(User::class, 'project_users');
    }      


}
