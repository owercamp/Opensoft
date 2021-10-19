<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainingcollaborator extends Model
{
    protected $table = "trainingcollaborators";
    protected $primaryKey = "tcoId";
    protected $fillable = [
        'tcoDate',
        'tcoDocument_id',
        'tcoDocumentcode',
        'tcoNametraining',
        'tcoNametrainer',
        'tcoLegalizations',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CAPACITACION PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'tcoDocument_id');
    }
}
