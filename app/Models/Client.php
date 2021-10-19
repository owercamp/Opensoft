<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";
    protected $primaryKey = "cliId";
    protected $fillable = [
        'cliType',
        'cliNumberdocument',
        'cliNamereason',
        'cliNamerepresentative',
        'cliNumberrepresentative',
        'cliMunicipality_id',
        'cliAddress',
        'cliPhone',
        'cliMovil',
        'cliWhatsapp',
        'cliEmail',
        'cliPdfrut',
        'cliPdfphotocopy',
        'cliPdfexistence',
        'cliPdflegal',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CLIENTE PERTENECE A UN MUNICIPIO
    public function municipality(){
        return $this->belongsTo(Settingmunicipality::class,'cliMunicipality_id');
    }
}
