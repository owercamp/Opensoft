<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $table = "variables";
    protected $primaryKey = "varId";
    protected $fillable = [
        'varDocument_id',
        'varName',
        'varType',
        'varLongitud',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA VARIABLE PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Document::class,'varDocument_id');
    }
}
