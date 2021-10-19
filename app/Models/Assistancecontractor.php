<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assistancecontractor extends Model
{
    protected $table = "assistancecontractors";
    protected $primaryKey = "ascId";
    protected $fillable = [
        'ascDate',
        'ascDocument_id',
        'ascDocumentcode',
        'ascBillcontractor_id',
        'ascAbsenteeism',
        'ascHourentry',
        'ascHourexit',
        'ascDescription',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA ASISTENCIA PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'ascDocument_id');
    }

    // CADA ASISTENCIA PERTENECE A UNA LEGALIZACION
    public function bill(){
        return $this->belongsTo(Billcontractor::class,'ascBillcontractor_id');
    }
}
