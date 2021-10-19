<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assistancecollaborator extends Model
{
    protected $table = "assistancecollaborators";
    protected $primaryKey = "acoId";
    protected $fillable = [
        'acoDate',
        'acoDocument_id',
        'acoDocumentcode',
        'acoLegalization_id',
        'acoAbsenteeism',
        'acoHourentry',
        'acoHourexit',
        'acoDescription',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA ASISTENCIA PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'acoDocument_id');
    }

    // CADA ASISTENCIA PERTENECE A UNA LEGALIZACION
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'acoLegalization_id');
    }
}
