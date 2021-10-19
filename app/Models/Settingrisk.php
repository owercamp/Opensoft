<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingrisk extends Model
{
    protected $table = "settingrisks";
    protected $primaryKey = "risId";
    protected $fillable = [
        'risName','created_at','updated_at'
    ];
    public $timestamps = true;
}
