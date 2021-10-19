<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billprovider extends Model
{
    protected $table = "billproviders";
    protected $primaryKey = "bpId";
    protected $fillable = [
        'bpDocument_id',
        'bpDocumentcode',
        'bpProvider_id',
        'bpConfigdocument_id',
        'bpContentfinal',
        'bpWrited',
        'bpState',
        'bpStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA MINUTA PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'bpDocument_id');
    }

    // CADA MINUTA PERTENECE A UN PROVEEDOR
    public function provider(){
        return $this->belongsTo(Provider::class,'bpProvider_id');
    }

    // CADA MINUTA PERTENECE A UNA CONFIGRACION PREDETERMINADA DE DOCUMENTO
    public function configdocument(){
        return $this->belongsTo(Configdocumentlogistic::class,'bpConfigdocument_id');
    }
}
