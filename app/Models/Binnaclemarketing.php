<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Binnaclemarketing extends Model
{
    protected $table = "binnaclemarketings";
    protected $primaryKey = "bmId";
    protected $fillable = [
        'bmDate',
        'bmObservation',
        'bmMarketing_id',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA SEGUIMIENTO DE LA BITACORA PERTENECE A UNA OPORTUNIDAD DE NEGOCIO
    public function marketing(){
        return $this->belongsTo(Marketing::class,'bmMarketing_id');
    }
}
