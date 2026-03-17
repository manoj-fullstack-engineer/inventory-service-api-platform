<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract_Product extends Model
{
    protected $table = 'contract_products';
    protected $fillable = ['cpname','category_id','pmodel','srno','price','cust_id','agrStatus','agrNo','agrDos','agrDoe','remark'];
    protected $hidden = ['created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id','id');
    }

    public function ledger()
    {
        return $this->hasMany(Ledger::class, 'srNo', 'srno');
    }
    public function setSrnoAttribute($value)
    {
        $this->attributes['srno'] = trim($value);
    }
    
}

