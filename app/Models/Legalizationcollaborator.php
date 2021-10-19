<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legalizationcollaborator extends Model
{
    protected $table = "legalizationcollaborators";
    protected $primaryKey = "lccId";
    protected $fillable = [
        'lccDocument_id',
        'lccBillcollaborator_id',
        'lccConfigdocument_id',
        'lccContentfinal',
        'lccWrited',
        'lccStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA LEGALIZACION TIENE UN DOCUMENTO
    public function document(){
        return $this->belongsTo(Documentlogistic::class,'lccDocument_id');
    }

    // CADA LEGALIZACION TIENE UNA MINUTA
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'lccBillcollaborator_id');
    }

    // CADA LEGALIZACION TIENE UNA CONFIGRACION PREDETERMINADA DE DOCUMENTO
    public function configdocument(){
        return $this->belongsTo(Configdocumentlogistic::class,'lccConfigdocument_id');
    }
}
