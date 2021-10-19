<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Briefcasemessengerexpress extends Model
{
    protected $table = "briefcasemessengerexpress";
    protected $primaryKey = "bmeId";
    protected $fillable = [
        'bmeYear',
        'bmeMunicipility_id',
        'bmeTypeservice_id',
        'bmeValueratebase',
        'bmeValuekilometres',
        'bmeValueminutewait',
        'bmeValuereturn',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA PORTAFOLIO DE MENSAJERIA TIENE UN TIPO DE SERVICIO
    public function service(){
        return $this->belongsTo(Settingservicemessenger::class,'bmeTypeservice_id');
    }
}
