<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountsReceivable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accounts_receivables';

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
        'price' => 'integer'
    ];

    public function origin()
    {
        return $this->hasOne(Settingmunicipality::class, 'munId', 'origin');
    }

    public function destiny()
    {
        return $this->hasOne(Settingmunicipality::class, 'munId', 'destiny');
    }
}
