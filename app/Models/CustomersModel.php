<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'location_photo',
        'gmap_link',
        'subscription_start_date',
        'package_id',
        'status',
        'longitude',
        'latitude',
    ];

        public function package(){
        return $this->belongsTo(PackagesModel::class, 'package_id', 'id');
        }
}
