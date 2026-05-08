<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingModel extends Model
{
    protected $table = 'billing';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'invoice',
        'customer_id',
        'period',
        'package_id',
        'amount',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomersModel::class, 'customer_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(PackagesModel::class, 'package_id', 'id');
    }
}
