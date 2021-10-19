<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alliesespecial extends Model
{
    protected $table = "alliesespecial";
    protected $primaryKey = "aeId";
    protected $fillable = [
        'aeReasonsocial',
        'aePersonal_id',
        'aeNumberdocument',
        'aeNumberregistration',
        'aeDateregistration',
        'aeCommerce',
        'aeNeighborhood_id',
        'aeAddress',
        'aeEmail',
        'aePhone',
        'aeMovil',
        'aeWhatsapp',
        'aeRepresentativename',
        'aeRepresentativepersonal_id',
        'aeRepresentativenumberdocument',
        'aeBank',
        'aeTypeaccount',
        'aeAccountnumber',
        'aeRegime',
        'aeTaxpayer',
        'aeAutoretainer',
        'aeActivitys',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
