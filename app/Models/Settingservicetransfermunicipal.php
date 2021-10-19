<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingservicetransfermunicipal extends Model
{
    protected $table = "settingservicestransfermunicipals";
    protected $primaryKey = "stmId";
    protected $fillable = [
        'stmTypeproduct_id',
        'stmService',
        'stmTimeavailability',
        'stmMunstart_id',
        'stmMunicipilityends',
        'stmKilometres',
        'stmDescription',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
