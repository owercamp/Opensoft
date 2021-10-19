<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Providerservice extends Model
{
    protected $table = "providersservices";
    protected $primaryKey = "psId";
    protected $fillable = [
        'psName',
        'psDescription',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
