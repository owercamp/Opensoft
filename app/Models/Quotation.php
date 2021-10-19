<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = "quotations";
    protected $primaryKey = "quoId";
    protected $fillable = [
        'quoType',
        'quoBidding_id',
        'quoProposal_id',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA COTIZACION PUEDE PERTENECER A UNA LICITACION PUBLICA
    public function bidding(){
        return $this->belongsTo(Clientbidding::class,'quoBidding_id');
    }

    // CADA COTIZACION PUEDE PERTENECER A UNA PROPUESTA COMERCIAL
    public function proposal(){
        return $this->belongsTo(Clientproposal::class,'quoProposal_id');
    }
}
