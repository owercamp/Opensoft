<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billcollaborator extends Model
{
    protected $table = "billcollaborators";
    protected $primaryKey = "bcoId";
    protected $fillable = [
        'bcoDocument_id',
        'bcoDocumentcode',
        'bcoCollaborator_id',
        'bcoConfigdocument_id',
        'bcoContentfinal',
        'bcoWrited',
        'bcoState',
        'bcoStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA MINUTA PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'bcoDocument_id');
    }

    // CADA MINUTA PERTENECE A UN CARGO
    public function collaborator(){
        return $this->belongsTo(Collaborator::class,'bcoCollaborator_id');
    }

    // CADA MINUTA PERTENECE A UNA CONFIGRACION PREDETERMINADA DE DOCUMENTO
    public function configdocument(){
        return $this->belongsTo(Configdocumentlogistic::class,'bcoConfigdocument_id');
    }
}
