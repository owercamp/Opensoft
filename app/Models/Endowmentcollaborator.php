<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endowmentcollaborator extends Model
{
    protected $table = "endowmentcollaborators";
    protected $primaryKey = "ecoId";
    protected $fillable = [
        'ecoDocument_id',
        'ecoDocumentcode',
        'ecoLegalization_id',
        'ecoDelivery',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA ENTREGA DE DOTACION TIENE UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'ecoDocument_id');
    }

    // CADA ENTREGA DE DOTACION TIENE UNA LEGALIZACION
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'ecoLegalization_id');
    }
}
