<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variablelogistic extends Model
{
    protected $table = "variableslogistic";
    protected $primaryKey = "valId";
    protected $fillable = [
        'valDocument_id',
        'valName',
        'valType',
        'valLongitud',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA VARIABLE PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'valDocument_id');
    }
}
