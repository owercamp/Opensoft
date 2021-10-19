<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientproposal extends Model
{
    protected $table = "clientproposals";
    protected $primaryKey = "cprId";
    protected $fillable = [
        'cprDate',
        'cprClient',
        'cprTypedocument_id',
        'cprNumberdocument',
        'cprMunicipility_id',
        'cprModalitycontract',
        'cprEmail',
        'cprPhone',
        'cprContact',
        'cprObservation',
        'cprBriefcase',
        'cprStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CLIENTE DE LA PROPUESTA PERTENECE A UN DEPARTAMENTO
    public function municipality(){
    	return $this->belongsTo(Settingmunicipality::class,'cprMunicipility_id');
    }
}
