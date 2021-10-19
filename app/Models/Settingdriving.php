<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingdriving extends Model
{
    protected $table = "settingdrivings";
    protected $primaryKey = "driId";
    protected $fillable = [
        'driCategory','driClassvehicle','driTypeservice','created_at','updated_at'
    ];
    public $timestamps = true;
}
