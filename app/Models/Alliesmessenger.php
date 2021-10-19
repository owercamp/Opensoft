<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alliesmessenger extends Model
{
    protected $table = "alliesmessenger";
    protected $primaryKey = "amId";
    protected $fillable = [
        'amReasonsocial',
        'amPersonal_id',
        'amNumberdocument',
        'amNumberregistration',
        'amDateregistration',
        'amCommerce',
        'amNeighborhood_id',
        'amAddress',
        'amEmail',
        'amPhone',
        'amMovil',
        'amWhatsapp',
        'amRepresentativename',
        'amRepresentativepersonal_id',
        'amRepresentativenumberdocument',
        'amBank',
        'amTypeaccount',
        'amAccountnumber',
        'amRegime',
        'amTaxpayer',
        'amAutoretainer',
        'amActivitys',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
