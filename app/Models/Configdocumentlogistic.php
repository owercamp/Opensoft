<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configdocumentlogistic extends Model
{
    protected $table = "configdocumentslogistic";
    protected $primaryKey = "cdlId";
    protected $fillable = [
        'cdlDocument_id',
        'cdlContent',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CONFIGURACION PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'cdlDocument_id');
    }
}
