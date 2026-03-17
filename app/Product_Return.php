<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Return extends Model
{
    protected $table = 'product_returns';

    protected $fillable = ['tanggal','productIssueTime','staff_id','product_id','qty', 'desc'];

    protected $hidden = ['created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

       
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

}
