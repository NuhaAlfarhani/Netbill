<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(CustomersModel::class, 'customer_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(PackagesModel::class, 'package_id', 'id');
    }
}
