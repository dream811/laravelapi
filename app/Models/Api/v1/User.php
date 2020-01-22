<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tb_users';
    protected $primaryKey = 'Admin_ID';

    public function personInfo()
    {
        return $this->belongsTo('App\Models\Api\v1\PersonInfo', 'n_PersonInfoId_FK');
    }

}
