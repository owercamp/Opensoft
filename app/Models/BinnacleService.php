<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinnacleService extends Model
{
    protected $table = 'binnacle_services';

    protected $primaryKey = 'bs_id';

    protected $guarded = [];

    public $timestamps = true;
}
