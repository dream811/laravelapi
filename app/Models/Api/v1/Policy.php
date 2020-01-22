<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{

    protected $table = 'tb_policies';
    protected $primaryKey = 'n_PolicyNoId_PK';

    /**
     * Returns a filtered collection of Policies
     *
     * @param  string  $filter - array of filtered fields in JSON format 
     * @return App\Models\Api\v1\Policy[] 
     */
    public static function getList(string $filter='')
    {
        $query = self::with(['product','insuredPerson','agency'])->whereNotNull('n_OwnerId_FK');

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
     * Product of the policy
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Api\v1\Product', 'n_ProductId_FK')->withDefault();
    }

    /**
     * Insured Person of the policy
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuredPerson()
    {
        return $this->belongsTo('App\Models\Api\v1\Person', 'n_OwnerId_FK')->withDefault();
    }

    /**
     * Agency of the policy
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agency()
    {
        return $this->belongsTo('App\Models\Api\v1\Person', 'n_AgencyPersoninfoId_FK')->withDefault();
    }

    /**
     * Claims of the policy
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claims()
    {
        return $this->hasMany('App\Models\Api\v1\Claim', 'n_PolicyNoId_FK'); 
    }
}
