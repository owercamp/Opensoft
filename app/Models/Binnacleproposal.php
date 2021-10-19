<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Binnacleproposal extends Model
{
    protected $table = "binnacleproposals";
    protected $primaryKey = "bpId";
    protected $fillable = [
        'bpDate',
        'bpObservation',
        'bpClientproposal_id',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA SEGUIMIENTO DE LA BITACORA PERTENECE A UNA OPORTUNIDAD DE NEGOCIO
    public function proposal(){
        return $this->belongsTo(Clientproposal::class,'bpClientproposal_id');
    }
}
