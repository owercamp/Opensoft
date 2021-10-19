<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settinghealth extends Model
{
    protected $table = "settinghealths";
    protected $primaryKey = "heaId";
    protected $fillable = [
        'heaName','created_at','updated_at'
    ];
    public $timestamps = true;
}
