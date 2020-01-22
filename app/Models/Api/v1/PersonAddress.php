<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class PersonAddress extends Model
{
    protected $table = 'tb_personaddresses';
    protected $primaryKey = 'n_PersonAddressesId_PK';

    public function person()
    {
        return $this->belongsTo('App\Models\Api\v1\Person', 'n_PersonId_FK'); 
    }

}
