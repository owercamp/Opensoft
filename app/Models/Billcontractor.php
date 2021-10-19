<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billcontractor extends Model
{
    protected $table = "billcontractors";
    protected $primaryKey = "bcId";
    protected $fillable = [
        'bcDocument_id',
        'bcDocumentcode',
        'bcTypecontractor',
        'bcContractormessenger_id',
        'bcContractorcharge_id',
        'bcContractorespecial_id',
        'bcConfigdocument_id',
        'bcContentfinal',
        'bcWrited',
        'bcState',
        'bcStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA MINUTA PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'bcDocument_id');
    }

    // CADA MINUTA PERTENECE A UN CONTRATISTA DE MENSAJERIA (Opcional) null por defecto
    public function messenger(){
        return $this->belongsTo(Contractormessenger::class,'bcContractormessenger_id');
    }

    // CADA MINUTA PERTENECE A UN CONTRATISTA DE CARGA EXPRESS (Opcional) null por defecto
    public function charge(){
        return $this->belongsTo(Contractorcharge::class,'bcContractorcharge_id');
    }

    // CADA MINUTA PERTENECE A UN CONTRATISTA DE SERVICIO ESPECIAL (Opcional) null por defecto
    public function especial(){
        return $this->belongsTo(Contractorespecial::class,'bcContractorespecial_id');
    }

    // CADA MINUTA PERTENECE A UNA CONFIGRACION PREDETERMINADA DE DOCUMENTO
    public function configdocument(){
        return $this->belongsTo(Configdocumentlogistic::class,'bcConfigdocument_id');
    }
}
