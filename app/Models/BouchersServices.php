<?php

namespace App\Models;

use App\Models\Settingmunicipality;
use Illuminate\Database\Eloquent\Model;

class BouchersServices extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bouchers_services';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'typeservices' => 'string',
        'origin' => 'integer',
        'destiny' => 'integer',
        'colaborator' => 'string',
        'price' => 'integer',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function originMunicipality()
    {
        return $this->belongsTo(Settingmunicipality::class, 'origin', 'munId');
    }

    public function destinyMunicipality()
    {
        return $this->belongsTo(Settingmunicipality::class, 'destiny', 'munId');
    }
}
