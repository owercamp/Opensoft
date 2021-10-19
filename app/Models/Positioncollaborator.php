<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Positioncollaborator extends Model
{
    protected $table = "positioncollaborators";
    protected $primaryKey = "pcoId";
    protected $fillable = [
        'pcoName',
        'pcoObservation',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
