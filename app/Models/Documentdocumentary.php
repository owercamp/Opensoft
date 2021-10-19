<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentdocumentary extends Model
{
    protected $table = "documentsdocumentary";
    protected $primaryKey = "dodId";
    protected $fillable = [
        'dodName',
        'dodCode',
        'dodVersion',
        'dodDate',
        'create_at',
        'updated_at'
    ];
    public $timestamps = true;
}
