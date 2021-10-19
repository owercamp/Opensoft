<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trackingsocialcontractor extends Model
{
    protected $table = "trackingsocialcontractors";
    protected $primaryKey = "tcId";
    protected $fillable = [
        'tcDate',
        'tcDocument_id',
        'tcDocumentcode',
        'tcBillcontractor_id',
        'tcPeriodpay',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA SEGUIMIENTO DE SEGURIDAD SOCIAL TIENE UN TIPO DE DOCUMENTO RELACIONADO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'tcDocument_id');
    }

    // CADA SEGUIMIENTO DE SEGURIDAD SOCIAL TIENE UNA LEGALIZACION (MINUTA DE CONTRATO APROBADA)
    public function bill(){
        return $this->belongsTo(Billcontractor::class,'tcBillcontractor_id');
    }
}
