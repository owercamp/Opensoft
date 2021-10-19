<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    protected $table = "collaborators";
    protected $primaryKey = "coId";
    protected $fillable = [
        'coPhoto',
        'coFirm',
        'coNames',
        'coPersonal_id',
        'coNumberdocument',
        'coPosition',
        'coNeighborhood_id',
        'coAddress',
        'coBloodtype',
        'coHealths_id',
        'coRisk_id',
        'coPension_id',
        'coLayoff_id',
        'coCompensation_id',
        'coEmail',
        'coMovil',
        'coWhatsapp',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA COLABORADOR TIENE UN TIPO DE DOCUMENTO
    public function type(){
        return $this->belongsTo(Settingpersonal::class,'coPersonal_id');
    }
}
