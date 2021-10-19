<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Binnacletrainingcollaborator extends Model
{
	// TABLA PIVOTE DE ASISTENTES DE CADA CAPACITACION DE COLABORADORES
    protected $table = "binnacletrainingcollaborators";
    protected $primaryKey = "btcId";
    protected $fillable = [
        'btcTraining_id',
        'btcLegalization_id',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA REGISTRO PERTENECE A UNA CAPACITACION
    public function training(){
        return $this->belongsTo(Trainingcollaborator::class,'btcTraining_id');
    }

    // CADA REGISTRO PERTENECE A UN ASISTENTE DE UNA DETERMINADA CAPACITACION (UN CONTRATO DE UN ASISTENTE)
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'btcLegalization_id');
    }
}
