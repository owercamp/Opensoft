<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handbookcontractor extends Model
{
    protected $table = "handbookcontractors";
    protected $primaryKey = "hcId";
    protected $fillable = [
        'hcDocument_id',
        'hcDocumentcode',
        'hcConfigdocument_id',
        'hcContentfinal',
        'hcWrited',
        'hcStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA MANUAL PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'hcDocument_id');
    }

    // CADA MANUAL PERTENECE A UNA CONFIGRACION PREDETERMINADA DE DOCUMENTO
    public function configdocument(){
        return $this->belongsTo(Configdocumentlogistic::class,'hcConfigdocument_id');
    }
}
