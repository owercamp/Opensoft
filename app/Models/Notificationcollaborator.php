<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificationcollaborator extends Model
{
    protected $table = "notificationcollaborators";
    protected $primaryKey = "ncoId";
    protected $fillable = [
        'ncoDate',
        'ncoDocument_id',
        'ncoDocumentcode',
        'ncoLegalization_id',
        'ncoNotification',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA NOTIFICACION PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'ncoDocument_id');
    }

    // CADA NOTIFICACION PERTENECE A UNA LEGALIZACION
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'ncoLegalization_id');
    }
}
