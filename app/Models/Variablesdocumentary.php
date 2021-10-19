<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variablesdocumentary extends Model
{
    protected $table = "variabledocumentary";
    protected $primaryKey = "valdId";
    protected $fillable = [
        'valdDocument_id',
        'valdName',
        'valdType',
        'valdLongitud',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    public function document(){
        return $this->belongsTo(Documentdocumentary::class, 'valdDocument_id');
    }
}
