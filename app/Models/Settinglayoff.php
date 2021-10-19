<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settinglayoff extends Model
{
    protected $table = "settinglayoffs";
    protected $primaryKey = "layId";
    protected $fillable = [
        'layName','created_at','updated_at'
    ];
    public $timestamps = true;
}
