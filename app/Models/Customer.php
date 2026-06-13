<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $guarded = ['id'];

    use SoftDeletes;

    public function package(){
        return $this->belongsTo(Package::class, 'package_id', 'id')->withTrashed();
    }
}
