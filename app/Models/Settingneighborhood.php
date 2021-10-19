<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingneighborhood extends Model
{
    protected $table = "settingneighborhoods";
    protected $primaryKey = "neId";
    protected $fillable = [
        'neZoning_id', // Foreign key (settingzonings)
        'neName', // Name => Varchar(50)
        'neCode', // Code postal => Enteger(10)
        'created_at', // timestamps
        'updated_at' // timestamps
    ];
    public $timestamps = true;

    // CADA BARRIOS PERTENECE A UNA ZONA
    public function zoning(){
    	return $this->belongsTo(Settingzoning::class,'neZoning_id');
    }
}
