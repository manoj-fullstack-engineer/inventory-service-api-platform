<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $table = 'ledgers';
    protected $fillable = ['srNo','date','staff_id','action_done','partsAndConsumables','totalSpent','preReading','todayReading','totalReading','remark'];

    protected $hidden = ['created_at','updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function contract_product()
    {
        return $this->belongsTo(Contract_Product::class, 'srno');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
