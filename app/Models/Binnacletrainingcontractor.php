<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Binnacletrainingcontractor extends Model
{
    // TABLA PIVOTE DE ASISTENTES DE CADA CAPACITACION DE CONTRATISTAS
    protected $table = "binnacletrainingcontractors";
    protected $primaryKey = "bicId";
    protected $fillable = [
        'bicTraining_id',
        'bicBillcontractor_id',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA REGISTRO PERTENECE A UNA CAPACITACION
    public function training(){
        return $this->belongsTo(Trainingcontractor::class,'bicTraining_id');
    }

    // CADA REGISTRO PERTENECE A UN ASISTENTE DE UNA DETERMINADA CAPACITACION (UN CONTRATO DE UN ASISTENTE)
    public function bill(){
        return $this->belongsTo(Billcontractor::class,'bicBillcontractor_id');
    }
}
