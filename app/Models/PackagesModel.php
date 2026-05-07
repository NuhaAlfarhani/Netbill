<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagesModel extends Model
{
    protected $table = 'packages';
    protected $primaryKey = 'id';

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
