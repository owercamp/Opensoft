<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examperiodcollaborator extends Model
{
    protected $table = "examsperiodcollaborators";
    protected $primaryKey = "epcId";
    protected $fillable = [
        'epcDate',
        'epcDocument_id',
        'epcDocumentcode',
        'epcLegalization_id',
        'epcCenter',
        'epcObservation',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA EXAMEN PERIODICO PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'epcDocument_id');
    }

    // CADA EXAMEN PERIODICO PERTENECE A UNA LEGALIZACION
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'epcLegalization_id');
    }
}
