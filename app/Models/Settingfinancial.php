<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingfinancial extends Model
{
    protected $table = "settingfinancials";
    protected $primaryKey = "fiId";
    protected $fillable = [
        'fiRegime',
        'fiTaxpayer',
        'fiAutoretainer',
        'fiActivitys',
        'fiResolutionfacturation',
        'fiDateresolutionfacturation',
        'fiMountcountresolution',
        'fiDatefallresolution',
        'fiPrefix',
        'fiNumberinitial',
        'fiNumberfinal',
        // DATOS DE BANCO Y CUENTA
        'fiBank',
        'fiBanklogo',
        'fiTypeaccount',
        'fiAccountnumber',
        'fiNotesone',
        'fiNotestwo',
        // NUMERCAION INICIAL
        'fiNumberinitialfacturation',
        'fiNumberinitialvoucherentry',
        'fiNumberinitialvoucheregress',
        // INDICADORES FINANCIEROS
        'fiCapitalwork',
        'fiHeritage',
        'fiIndexsettlement',
        'fiIndexdebt',
        'fiReasoncoverage',
        'fiProfitabilityheritage',
        'fiProfitabilityactives',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
