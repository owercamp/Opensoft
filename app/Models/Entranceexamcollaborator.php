<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entranceexamcollaborator extends Model
{
    protected $table = "entranceexamscollaborators";
    protected $primaryKey = "eecId";
    protected $fillable = [
        'eecDate',
        'eecDocument_id',
        'eecDocumentcode',
        'eecLegalization_id',
        'eecCenter',
        'eecObservation',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA EXAMEN DE INGRESO PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'eecDocument_id');
    }

    // CADA EXAMEN DE INGRESO PERTENECE A UNA LEGALIZACION
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'eecLegalization_id');
    }
}
