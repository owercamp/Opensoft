<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingproducttransfermunicipal extends Model
{
    protected $table = "settingproductstransfermunicipals";
    protected $primaryKey = "ptmId";
    protected $fillable = [
        'ptmProduct',
        'ptmDescription',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
