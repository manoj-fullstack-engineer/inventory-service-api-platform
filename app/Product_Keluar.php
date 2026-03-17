<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Keluar extends Model
{
    protected $table = 'product_keluar';

    protected $fillable = ['tanggal','productIssueTime','customer_id','partsAndConsumables', 'totalAmount','staff_id', 'desc'];

    protected $hidden = ['created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

}
