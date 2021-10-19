<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configdocument extends Model
{
    protected $table = "configdocuments";
    protected $primaryKey = "cdoId";
    protected $fillable = [
        'cdoDocument_id',
        'cdoContent',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CONFIGURACION PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Document::class,'cdoDocument_id');
    }
}
