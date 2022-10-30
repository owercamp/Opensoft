<?php

namespace App\Models;

use App\Models\Settingmunicipality;
use Illuminate\Database\Eloquent\Model;

class CustomerRating extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_ratings';

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
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

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
        'collaborator' => 'string',
        'stars' => 'string',
        'comments' => 'string'
    ];

    public function origins()
    {
        return $this->hasOne(Settingmunicipality::class, 'munId', 'origin');
    }

    public function destinys()
    {
        return $this->hasOne(Settingmunicipality::class, 'munId', 'destiny');
    }
}
