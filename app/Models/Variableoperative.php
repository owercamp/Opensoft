<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variableoperative extends Model
{
    protected $table = "variablesoperative";
    protected $primaryKey = "valOId";
    protected $fillable = [
        'valODocument_id',
        'valOName',
        'valOType',
        'valOLongitud',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    public function document(){
        return $this->belongsTo(Documentoperative::class, 'valODocument_id');
    }
}
