<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;


class County extends Model
{
    protected $table = 'tb_counties';
    protected $primaryKey = 'n_CountyId_PK';

    public function state(){
        return $this->belongsTo('App\Models\Api\v1\State','n_StateId_FK');
    }

}