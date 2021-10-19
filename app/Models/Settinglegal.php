<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settinglegal extends Model
{
    protected $table = "settinglegals";
    protected $primaryKey = "leId";
    protected $fillable = [
        'leReasonsocial',
        'lePersonal_id',
        'leNumberdocument',
        'leNumberregistration',
        'leDateregistration',
        'leCommerce',
        'leNeighborhood_id',
        'leAddress',
        'leEmail',
        'lePhone',
        'leMovil',
        'leWhatsapp',
        'leRepresentativename',
        'leRepresentativepersonal_id',
        'leRepresentativenumberdocument',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
