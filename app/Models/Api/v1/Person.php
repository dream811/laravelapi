<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'tb_personinfos';
    protected $primaryKey = 'n_PersonInfoId_PK';

    /**
     * Returns a filtered collection of Policies
     *
     * @param  string  $filter - array of filtered fields in JSON format 
     * @return App\Models\Api\v1\Policy[] 
     */
    public static function getList(string $filter='')
    {
        $query = self::with(['addresses']);

        $filterArray = json_decode(request('filter'));

        if (is_object($filterArray)) {
            foreach($filterArray as $key=>$value) {
                if (empty($value)) {
                    continue;
                }
                if (is_array($value)) {
                    $query->whereIn($key, $value);
                    continue;
                }
                $query->where($key, 'like', "%$value%");
            }
        }
        return $query;
    }

    /**
     * Addresses of the person
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Api\v1\PersonAddress', 'n_PersonId_FK'); 
    }
}
