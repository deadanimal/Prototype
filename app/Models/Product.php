<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'prototype_link',
        'web_link',
        'web_repo',
        'app_repo',
    ];  

    public function actors()
    {
        return $this->hasMany(ProductActor::class);
    }   
    
    public function tables()
    {
        return $this->hasMany(ProductTable::class);
    }   
    
    public function attributes()
    {
        return $this->hasMany(ProductTableAttribute::class);
    }   
    
    public function usecases()
    {
        return $this->hasMany(ProductUsecase::class);
    }      
    
    
}
