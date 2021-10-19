<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderoccasional extends Model
{
    protected $table = "orderoccasionals";
    protected $primaryKey = "oroId";
    protected $fillable = [
        'oroDocument_id',
        'oroDocumentcode',
        'oroDatestart',
        'oroDateend',
        'oroClientproposal_id',
        'oroAllproposal',
        'oroConfigdocument_id',
        'oroContentfinal',
        'oroWrited',
        'oroState',
        'oroStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA ORDEN DE SERVICIO DE CONTRATO OCASIONAL PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Document::class,'oroDocument_id');
    }

    // CADA ORDEN DE SERVICIO DE CONTRATO OCASIONAL PERTENECE A UNA PROPUESTA COMERCIAL
    public function proposal(){
        return $this->belongsTo(Clientproposal::class,'oroClientproposal_id');
    }

    // CADA ORDEN DE SERVICIO DE CONTRATO OCASIONAL PERTENECE A UNA CONFIGURACION PREDETERMINADA DE DOCUMENTO
    public function configdocument(){
        return $this->belongsTo(Configdocument::class,'oroConfigdocument_id');
    }
}
