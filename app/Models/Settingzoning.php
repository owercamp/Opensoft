<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingzoning extends Model
{
    protected $table = "settingzonings";
    protected $primaryKey = "zonId";
    protected $fillable = [
        'zonMunicipality_id','zonName','created_at','updated_at'
    ];
    public $timestamps = true;

    // CADA ZONA PERTENECE A UN MUNICIPIO
    public function municipality(){
    	return $this->belongsTo(Settingmunicipality::class,'zonMunicipality_id');
    }

    // CADA ZONA TIENE MUCHOS BARRIOS
    public function neighborhoods(){
    	return $this->hasMany(Settingneighborhood::class);
    }
}
