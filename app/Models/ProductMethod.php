<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMethod extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'inputs',
        'outputs',
        'calculations',
        'remarks',
        'platform',
        'product_id',
    ];     
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }  
         
}
