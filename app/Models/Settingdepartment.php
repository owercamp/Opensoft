<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingdepartment extends Model
{
    protected $table = "settingdepartments";
    protected $primaryKey = "depId";
    protected $fillable = [
        'depName','created_at','updated_at'
    ];
    public $timestamps = true;

    // CADA DEPARTAMENTO TIENE MUCHOS MUNICIPIOS
    public function municipalities(){
    	return $this->hasMany(Settingmunicipality::class);
    }
}
