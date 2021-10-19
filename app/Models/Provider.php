<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = "providers";
    protected $primaryKey = "proId";
    protected $fillable = [
        'proReasonsocial',
        'proPersonal_id',
        'proNumberdocument',
        'proNumberregistration',
        'proDateregistration',
        'proCommerce',
        'proNeighborhood_id',
        'proAddress',
        'proEmail',
        'proPhone',
        'proMovil',
        'proWhatsapp',
        'proRepresentativename',
        'proRepresentativepersonal_id',
        'proRepresentativenumberdocument',
        'proBank',
        'proTypeaccount',
        'proAccountnumber',
        'proRegime',
        'proTaxpayer',
        'proAutoretainer',
        'proActivitys',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA PROVEEDOR TIENE UN TIPO DE IDENTIFICACION
    public function document(){
        return $this->belongsTo(Settingpersonal::class,'proPersonal_id');
    }
}
