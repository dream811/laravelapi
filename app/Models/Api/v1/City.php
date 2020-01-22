<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'tb_cities';
    protected $primaryKey = 'n_CityId_PK';

    public function county(){
        $this->belongsTo('App\Models\Api\v1\County','n_CountyId_FK');
    }
}
