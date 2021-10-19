<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configdocumentsdocumentary extends Model
{
    protected $table = "configdocumentsdocumentary";
    protected $primaryKey = "cddId";
    protected $fillable = [
        "cddDocument_id",
        "cddContent",
        "created_at",
        "updated_at"
    ];
    public $timestamps = true;

    public function document(){
        return $this->belongsTo(Documentdocumentary::class, "cddDocument_id");
    }
}
