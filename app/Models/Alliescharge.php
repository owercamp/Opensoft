<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alliescharge extends Model
{
    protected $table = "alliescharge";
    protected $primaryKey = "acId";
    protected $fillable = [
        'acReasonsocial',
        'acPersonal_id',
        'acNumberdocument',
        'acNumberregistration',
        'acDateregistration',
        'acCommerce',
        'acNeighborhood_id',
        'acAddress',
        'acEmail',
        'acPhone',
        'acMovil',
        'acWhatsapp',
        'acRepresentativename',
        'acRepresentativepersonal_id',
        'acRepresentativenumberdocument',
        'acBank',
        'acTypeaccount',
        'acAccountnumber',
        'acRegime',
        'acTaxpayer',
        'acAutoretainer',
        'acActivitys',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
