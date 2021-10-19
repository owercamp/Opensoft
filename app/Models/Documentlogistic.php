<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentlogistic extends Model
{
    protected $table = "documentslogistic";
    protected $primaryKey = "dolId";
    protected $fillable = [
        'dolName',
        'dolCode',
        'dolVersion',
        'dolDate',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
