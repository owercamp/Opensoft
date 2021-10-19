<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientbidding extends Model
{
    protected $table = "clientbiddings";
    protected $primaryKey = "cbiId";
    protected $fillable = [
        'cbiNumberprocess',
        'cbiDateopen',
        'cbiDateclose',
        'cbiEntity',
        'cbiMunicipility_id',
        'cbiModalitycontract',
        'cbiObjectcontract',
        'cbiEmail',
        'cbiObservation',
        'cbiStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
