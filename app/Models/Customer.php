<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];

    public function package(){
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}
