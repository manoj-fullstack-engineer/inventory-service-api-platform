<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['nama', 'alamat', 'email', 'telepon'];
    protected $hidden = ['created_at', 'updated_at'];

    public function contract_product()
    {
        // return $this->hasMany(Contract_Product::class);
        return $this->hasMany(Contract_Product::class, 'cust_id', 'id');
    }

}
