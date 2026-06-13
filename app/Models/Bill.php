<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    protected $guarded = ['id'];

    use SoftDeletes;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withTrashed();
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id')->withTrashed();
    }
}
