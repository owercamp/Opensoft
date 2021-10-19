<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Briefcaselogisticexpress extends Model
{
    protected $table = "briefcaselogisticexpress";
    protected $primaryKey = "bleId";
    protected $fillable = [
        'bleYear',
        'bleMunicipility_id',
        'bleTypeservice_id',
        'bleValueratebase',
        'bleValueminutewait',
        'bleValuereturn',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA PORTAFOLIO DE LOGISTICA TIENE UN TIPO DE SERVICIO
    public function service(){
        return $this->belongsTo(Settingservicelogistic::class,'bleTypeservice_id');
    }
}
