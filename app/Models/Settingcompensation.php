<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingcompensation extends Model
{
    protected $table = "settingcompensations";
    protected $primaryKey = "comId";
    protected $fillable = [
        'comName','created_at','updated_at'
    ];
    public $timestamps = true;
}
