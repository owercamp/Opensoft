<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Briefcasetransferexpress extends Model
{
    protected $table = "briefcasetransferexpress";
    protected $primaryKey = "btreId";
    protected $fillable = [
        'btreYear',
        'btreMunicipility_id',
        'btreTypevehicle_id',
        'btreTypeservice_id',
        'btreValueratebase',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA PORTAFOLIO DE TRASLADO TIENE UN TIPO DE SERVICIO
    public function service(){
        return $this->belongsTo(Settingservicetransfer::class,'btreTypeservice_id');
    }

    // CADA PORTAFOLIO DE TRASLADO TIENE UN TIPO DE VEHICULO DE ESPECIAL
    public function vehicle(){
        return $this->belongsTo(Settingespecial::class,'btreTypevehicle_id');
    }
}
