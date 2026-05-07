<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersModel extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'location_photo',
        'gmap_link',
        'subscription_start_date',
        'package',
        'status',
        'longitude',
        'latitude',
    ];
}
