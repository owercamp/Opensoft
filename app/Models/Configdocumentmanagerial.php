<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configdocumentmanagerial extends Model
{
    protected $table = "configdocumentsmanagerial";
    protected $primaryKey = "cdmId";
    protected $fillable = [
        'cdmDocument_id',
        'cdmContent',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CONFIGURACION PERTENESE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentmanagerial::class, 'cdmDocument_id');
    }
}



