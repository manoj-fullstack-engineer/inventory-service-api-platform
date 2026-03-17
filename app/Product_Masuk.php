<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Masuk extends Model
{
    protected $table = 'product_masuk';

    protected $fillable = ['tanggal','supplier_id','partsAndConsumables', 'totalAmount','desc'];

    protected $hidden = ['created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
