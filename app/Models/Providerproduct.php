<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Providerproduct extends Model
{
    protected $table = "providersproducts";
    protected $primaryKey = "ppId";
    protected $fillable = [
        'ppName',
        'ppDescription',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
