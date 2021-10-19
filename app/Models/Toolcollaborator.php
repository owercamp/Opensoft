<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toolcollaborator extends Model
{
    protected $table = "toolcollaborators";
    protected $primaryKey = "tcoId";
    protected $fillable = [
        'tcoDate',
        'tcoDocument_id',
        'tcoDocumentcode',
        'tcoLegalization_id',
        'tcoDelivery',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA ENTREGA PERTENECE A UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'tcoDocument_id');
    }

    // CADA ENTREFA PERTENECE A UNA LEGALIZACION
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'tcoLegalization_id');
    }
}
