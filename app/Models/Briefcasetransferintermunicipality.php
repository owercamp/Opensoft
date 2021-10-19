<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Briefcasetransferintermunicipality extends Model
{
    protected $table = "briefcasetransferintermunicipalities";
    protected $primaryKey = "btriId";
    protected $fillable = [
        'btriYear',
        'btriTypevehicle_id',
        'btriTypeservice_id',
        'btriValuebase',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA PORTAFOLIO DE TRASLADO TIENE UN TIPO DE SERVICIO
    public function service(){
        return $this->belongsTo(Settingservicetransfermunicipal::class,'btriTypeservice_id');
    }

    // CADA PORTAFOLIO DE TRASLADO TIENE UN TIPO DE VEHICULO
    public function vehicle(){
        return $this->belongsTo(Settingespecial::class,'btriTypevehicle_id');
    }
}
