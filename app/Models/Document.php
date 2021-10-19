<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "documents";
    protected $primaryKey = "docId";
    protected $fillable = [
        'docName',
        'docCode',
        'docVersion',
        'docDate',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA DOCUMENTO TIENE UNA O MUCHAS VARIABLES
    public function variables(){
        return $this->hasMany(Variable::class);
    }
}
