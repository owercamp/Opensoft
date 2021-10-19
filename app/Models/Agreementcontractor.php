<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agreementcontractor extends Model
{
    protected $table = "agreementcontractors";
    protected $primaryKey = "agcId";
    protected $fillable = [
        'agcDocument_id',
        'agcDocumentcode',
        'agcTypecontractor',
        'agcBillcontractor_id',
        'agcAlliesmessenger_id',
        'agcAlliescharge_id',
        'agcAlliesespecial_id',
        'agcConfigdocument_id',
        'agcContentfinal',
        'agcWrited',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CONVENIO DE COLABORACION TIENE UN TIPO DE DOCUMENTO RELACIONADO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'agcDocument_id');
    }

    // CADA CONVENIO DE COLABORACION TIENE UNA LEGALIZACION (MINUTA DE CONTRATO APROBADA)
    public function bill(){
        return $this->belongsTo(Billcontractor::class,'agcBillcontractor_id');
    }

    // CADA CONVENIO DE COLABORACION TIENE UNA EMPRESA ALIADA DE MENSAJERIA (OPCIONAL - PUEDE SER CAMPO NULO)
    public function alliesmessenger(){
        return $this->belongsTo(Alliesmessenger::class,'agcAlliesmessenger_id');
    }

    // CADA CONVENIO DE COLABORACION TIENE UNA EMPRESA ALIADA DE CARGA EXPRESS (OPCIONAL - PUEDE SER CAMPO NULO)
    public function alliescharge(){
        return $this->belongsTo(Alliescharge::class,'agcAlliescharge_id');
    }

    // CADA CONVENIO DE COLABORACION TIENE UNA EMPRESA ALIADA DE SERVICIO ESPECIAL (OPCIONAL - PUEDE SER CAMPO NULO)
    public function alliesespecial(){
        return $this->belongsTo(Alliesespecial::class,'agcAlliesespecial_id');
    }

    // CADA CONVENIO DE COLABORACION PERTENECE A UNA CONFIGURACION PREDETERMINADA DE DOCUMENTO
    public function configdocument(){
        return $this->belongsTo(Configdocumentlogistic::class,'agcConfigdocument_id');
    }
}
