<?php

namespace App\MOdels;

use Illuminate\Database\Eloquent\Model;

class Orderprovider extends Model
{
    protected $table = "orderproviders";
    protected $primaryKey = "orpId";
    protected $fillable = [
        'orpDocument_id',
        'orpDocumentcode',
        'orpBillprovider_id',
        'orpOrders',
        'orpSubtotal',
        'orpIva',
        'orpTotal',
        'orpNote',
        'orpStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA ORDEN DE SERVICIO DE PROVEEDOR PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'orpDocument_id');
    }

    // CADA ORDEN DE SERVICIO DE PROVEEDOR PERTENECE A UNA LEGALIZACION (MINUTA DE CONTRATO DE PROVEEDOR)
    public function bill(){
        return $this->belongsTo(Billprovider::class,'orpBillprovider_id');
    }
}
