<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class TbPersonInfo extends Model
{
    protected $table = 'tb_personinfos';
    public $timestamps = false;
    protected $primaryKey = 'n_PersonInfoId_PK';
    protected $fillable = ['s_PersonUniqueId', 's_FullLegalName', 's_DBAName', 's_PersonStatusCode', 's_PayeeName'];

    public function agencyMailingAddress()
    {
        // return $this->belongsTo(Address::class);
    }

    public function agencyLocationAddress()
    {
        // return $this->belongsTo(Address::class);
    }
}
