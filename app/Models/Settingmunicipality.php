<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingmunicipality extends Model
{
    protected $table = "settingmunicipalities";
    protected $primaryKey = "munId";
    protected $fillable = [
        'munDepartment_id','munName','created_at','updated_at'
    ];
    public $timestamps = true;

    // CADA MUNICIPIO PERTENECE A UN DEPARTAMENTO
    public function department(){
    	return $this->belongsTo(Settingdepartment::class,'munDepartment_id');
    }

    // CADA MUNICIPIO TIENE MUCHAS ZONAS
    public function zonings(){
    	return $this->hasMany(Settingzoning::class);
    }
}
