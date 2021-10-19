<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingproductlogistic extends Model
{
    protected $table = "settingproductslogistic";
    protected $primaryKey = "plId";
    protected $fillable = [
        'plProduct','plDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
