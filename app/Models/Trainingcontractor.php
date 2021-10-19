<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainingcontractor extends Model
{
    protected $table = "trainingcontractors";
    protected $primaryKey = "trcId";
    protected $fillable = [
        'trcDate',
        'trcDocument_id',
        'trcDocumentcode',
        'trcNametraining',
        'trcNametrainer',
        'trcLegalizations',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CAPACITACION PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'trcDocument_id');
    }
}
