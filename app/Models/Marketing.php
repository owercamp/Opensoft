<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    protected $table = "marketings";
    protected $primaryKey = "marId";
    protected $fillable = [
        'marDate',
        'marReason',
        'marMunicipility_id',
        'marAddress',
        'marContact',
        'marPhone',
        'marEmail',
        'marObservation',
        'marStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA RAZON SOCIAL DE OPORTUNIDAD DE NEGOCIO PERTENECE A UN MUNICIPIO
    public function municipality(){
        return $this->belongsTo(Settingmunicipality::class,'marMunicipility_id');
    }

    // CADA OPORTUNIDAD TIENE UNO O MUCHOS SEGUIMIENTOS
    public function binnacles(){
        return $this->hasMany(Binnaclemarketing::class);
    }
}
