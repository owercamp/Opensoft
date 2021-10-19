<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Binnaclebidding extends Model
{
    protected $table = "binnaclebiddings";
    protected $primaryKey = "bbId";
    protected $fillable = [
        'bbDate',
        'bbObservation',
        'bbClientbidding_id',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA SEGUIMIENTO DE LA BITACORA PERTENECE A UNA OPORTUNIDAD DE NEGOCIO
    public function bidding(){
        return $this->belongsTo(Clientbidding::class,'bbClientbidding_id');
    }
}
