<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = "terms";
    protected $primaryKey = "terId";
    protected $fillable = [
        'terLegalization_id',
        'terDateinitial',
        'terDatefinal',
        'terBriefcase',
        'terStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA TERMINO/CONDICION PERTENECE A UNA LEGALIZACION
    public function legalization(){
        return $this->belongsTo(Legalizationcontractual::class,'terLegalization_id');
    }
}
