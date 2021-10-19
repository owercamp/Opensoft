<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activationcontractor extends Model
{
    protected $table = "activationcontractors";
    protected $primaryKey = "accId";
    protected $fillable = [
        'accTypecontractor',
        'accContractormessenger_id',
        'accContractorcharge_id',
        'accContractorespecial_id',
        'accState',
        'accDateend',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA ACTIVACION PERTENECE A UN CONTRATISTA DE MENSAJERIA (Opcional) null por defecto
    public function messenger(){
        return $this->belongsTo(Contractormessenger::class,'accContractormessenger_id');
    }

    // CADA ACTIVACION PERTENECE A UN CONTRATISTA DE CARGA EXPRESS (Opcional) null por defecto
    public function charge(){
        return $this->belongsTo(Contractorcharge::class,'accContractorcharge_id');
    }

    // CADA ACTIVACION PERTENECE A UN CONTRATISTA DE SERVICIO ESPECIAL (Opcional) null por defecto
    public function especial(){
        return $this->belongsTo(Contractorespecial::class,'accContractorespecial_id');
    }
}
