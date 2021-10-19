<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentoperative extends Model
{
    protected $table = "documentsoperative";
    protected $primaryKey = "doOId";
    protected $fillable =[
        'doOName',
        'doOCode',
        'doOVersion',
        'doODate',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
