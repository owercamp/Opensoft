<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierEvaluation extends Model
{
    protected $table = 'supplier_evaluations';

    protected $primaryKey = 'su_id';

    protected $guarded = [];

    public $timestamps = true;

    public function provider()
    {
      return $this->belongsTo(Provider::class, 'su_provider');
    }
}
