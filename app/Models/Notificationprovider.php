<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificationprovider extends Model
{
    protected $table = "notificationproviders";
    protected $primaryKey = "npId";
    protected $fillable = [
        'npDate',
        'npDocument_id',
        'npDocumentcode',
        'npBillprovider_id',
        'npNotification',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA NOTIFICACION PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'npDocument_id');
    }

    // CADA NOTIFICACION PERTENECE A UNA LEGALIZACION (MINUTA DE CONTRATO DE PROVEEDOR)
    public function bill(){
        return $this->belongsTo(Billprovider::class,'npBillprovider_id');
    }
}
