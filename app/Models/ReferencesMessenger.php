<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferencesMessenger extends Model
{
    protected $table = 'references_messengers';

    protected $primaryKey = 'rc_id';

    protected $guarded = [];

    public $timestamps = true;

    public function collaborator()
    {
      // !relacion con la tabla de contractorsmessenger
      return $this->belongsTo(Contractormessenger::class, 'rc_collaborator_id');
    }
}
