<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tb_products';
    protected $primaryKey = 'n_ProductId_PK';
}
