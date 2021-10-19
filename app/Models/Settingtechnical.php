<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingtechnical extends Model
{
    protected $table = "settingtechnicals";
    protected $primaryKey = "teId";
    protected $fillable = [
        'teResolutiontransport',
        'teDateresolutiontransport',
        'teResolutioncapacity',
        'teDateresolutioncapacity',
        'teCertificate',
        'teNoteonecertificate',
        'teNotetwocertificate',
        'teCodeqr',
        'teLogotransport',
        'teLogocompany',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
