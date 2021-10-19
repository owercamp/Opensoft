<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentmanagerial extends Model
{
    protected $table = "documentsmanagerial";
    protected $primaryKey = "domId";
    protected $fillable = [
        'domName',
        'domCode',
        'domVersion',
        'domDate',
        'create_at',
        'updated_at'
    ];
    public $timestamps = true;
}
