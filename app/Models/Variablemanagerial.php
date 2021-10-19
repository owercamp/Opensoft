<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variablemanagerial extends Model
{
    protected $table = "variablesmanagerial";
    protected $primaryKey = "valmid";
    protected $fillable = [
        'valmDocument_id',
        'valmName',
        'valmType',
        'valmLongitud',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    public function document(){
        return $this->belongsTo(Documentmanagerial::class, 'valmDocument_id');
    }
}
