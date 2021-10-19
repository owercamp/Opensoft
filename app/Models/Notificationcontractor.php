<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificationcontractor extends Model
{
    protected $table = "notificationcontractors";
    protected $primaryKey = "ncId";
    protected $fillable = [
        'ncDate',
        'ncDocument_id',
        'ncDocumentcode',
        'ncBillcontractor_id',
        'ncNotification',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA NOTIFICACION PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'ncDocument_id');
    }

    // CADA NOTIFICACION PERTENECE A UNA LEGALIZACION (MINUTA DE CONTRATO)
    public function bill(){
        return $this->belongsTo(Billcontractor::class,'ncBillcontractor_id');
    }
}
