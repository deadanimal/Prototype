<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTable extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'db_name',
        'product_id',
    ];     
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }   
    
    public function attributes()
    {
        return $this->hasMany(ProductTableAttribute::class);
    }     
}
