<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exitexamcollaborator extends Model
{
    protected $table = "exitexamscollaborators";
    protected $primaryKey = "excId";
    protected $fillable = [
        'excDate',
        'excDocument_id',
        'excDocumentcode',
        'excLegalization_id',
        'excCenter',
        'excObservation',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA EXAMEN DE EGRESO PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'excDocument_id');
    }

    // CADA EXAMEN DE EGRESO PERTENECE A UNA LEGALIZACION
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'excLegalization_id');
    }
}
