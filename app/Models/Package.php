<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'speed',
        'price',
        'description',
    ];

    public function customers()
    {
        return $this->hasMany(CustomersModel::class, 'package_id', 'id');
    }
}
