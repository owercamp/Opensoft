<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variablesimprovement extends Model
{
    protected $table = "variablesimprovement";
    protected $primaryKey = "valIId";
    protected $fillable = [
        'valIDocument_id',
        'valIName',
        'valIType',
        'valILongitud',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    public function document(){
        return $this->belongsTo(Documentimprovement::class, 'valIDocument_id');
    }
}
