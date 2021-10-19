<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingproducttransfer extends Model
{
    protected $table = "settingproductstransfer";
    protected $primaryKey = "ptrId";
    protected $fillable = [
        'ptrProduct','ptrAvailability','ptrDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
