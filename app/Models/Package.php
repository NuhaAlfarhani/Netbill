<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    protected $guarded = ['id'];

    use SoftDeletes;

    public function customers()
    {
        return $this->hasMany(Customer::class, 'package_id', 'id');
    }
}
