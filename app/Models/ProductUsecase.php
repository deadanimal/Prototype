<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUsecase extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'product_id',
        'product_actor_id',
    ];     
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }  
    
    public function actor()
    {
        return $this->belongsTo(ProductActor::class, 'product_actor_id');
    }        
}
