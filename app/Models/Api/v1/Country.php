<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    protected $table = 'tb_countries';
    protected $primaryKey = 'n_CountryId_PK';
}