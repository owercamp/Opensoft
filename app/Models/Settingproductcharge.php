<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingproductcharge extends Model
{
    protected $table = "settingproductscharge";
    protected $primaryKey = "pcId";
    protected $fillable = [
        'pcProduct',
        'pcDescription',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
