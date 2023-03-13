<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTableAttribute extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'datatype',
        'default',
        'nullable',
        'foreign_key',
        'product_id',
        'product_table_id',
    ];     
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }  
    
    public function table()
    {
        return $this->belongsTo(ProductTable::class, 'product_table_id');
    }     
}
