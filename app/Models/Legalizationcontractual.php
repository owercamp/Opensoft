<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legalizationcontractual extends Model
{
    protected $table = "legalizationscontractual";
    protected $primaryKey = "lcoId";
    protected $fillable = [
        'lcoDocument_id',
        'lcoClient_id',
        'lcoConfigdocument_id',
        'lcoContentfinal',
        'lcoWrited',
        'lcoStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA LEGALIZACION PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Document::class,'lcoDocument_id');
    }

    // CADA LEGALIZACION PERTENECE A UN CLIENTE
    public function client(){
        return $this->belongsTo(Client::class,'lcoClient_id');
    }

    // CADA LEGALIZACION PERTENECE A UNA CONFIGRACION PREDETERMINADA DE DOCUMENTO
    public function configdocument(){
        return $this->belongsTo(Configdocument::class,'lcoConfigdocument_id');
    }
}
