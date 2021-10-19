<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configdocumentimprovement extends Model
{
    protected $table = "configdocumentsimprovement";
    protected $primaryKey = "cdiId";
    protected $fillable = [
        "cdiDocument_id",
        "cdiContent",
        "created_at",
        "updated_at"
    ];
    public $timestamps = true;

    public function document(){
        return $this->belongsTo(Documentimprovement::class, "cdiDocument_id");
    }
}
