<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $fillable = ['staffName', 'dob', 'designation', 'address', 'email', 'telephone', 'doj', 'dol','remark'];
    protected $hidden = ['created_at', 'updated_at'];
}

?>
