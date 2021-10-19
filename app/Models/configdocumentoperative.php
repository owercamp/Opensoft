<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class configdocumentoperative extends Model
{
    protected $table = "configdocumentsoperative";
    protected $primaryKey = "cdoId";
    protected $fillable = [
        'cdoDocument_id',
        'cdoContent',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    public function document(){
        return $this->belongsTo(Documentoperative::class, 'cdoDocument_id');
    }
}
