<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handbookcollaborator extends Model
{
    protected $table = "handbookcollaborators";
    protected $primaryKey = "hcoId";
    protected $fillable = [
        'hcoPosition_id',
        'hcoDocument_id',
        'hcoDocumentcode',
        'hcoConfigdocument_id',
        'hcoContentfinal',
        'hcoWrited',
        'hcoStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA MANUAL PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'hcoDocument_id');
    }

    // CADA MANUAL PERTENECE A UN CARGO
    public function position(){
        return $this->belongsTo(Positioncollaborator::class,'hcoPosition_id');
    }

    // CADA MANUAL PERTENECE A UNA CONFIGRACION PREDETERMINADA DE DOCUMENTO
    public function configdocument(){
        return $this->belongsTo(Configdocumentlogistic::class,'hcoConfigdocument_id');
    }
}
