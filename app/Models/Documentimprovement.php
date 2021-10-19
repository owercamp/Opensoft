<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentimprovement extends Model
{
    protected $table = "documentsimprovement";
    protected $primaryKey = "doIId";
    protected $fillable = [
        'doIName',
        'doICode',
        'doIVersion',
        'doIDate',
        'create_at',
        'updated_at'
    ];
    public $timestamps = true;
}
