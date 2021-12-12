<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestshasContractors extends Model
{
    protected $table = "requestshas_contractors";

    protected $primaryKey = "rc_id";

    protected $guarded = [];

    public $timestamps = true;
    
}
