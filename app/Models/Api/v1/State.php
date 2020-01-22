<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'tb_states';
    protected $primaryKey = 'n_StateId_PK';

    public function country()
    {
        return $this->belongsTo('App\Models\Api\v1\Country','n_CountryId_FK');
    }
}
