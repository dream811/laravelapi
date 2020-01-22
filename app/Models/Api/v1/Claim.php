<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $table = 'tb_claim';
    protected $primaryKey = 'ClaimId_PK';

    /**
     * Returns a filtered collection of Claims
     *
     * @param  string  $filter - array of filtered fields in JSON format 
     * @return App\Models\Api\v1\Claim[] 
     */
    public static function getList(string $filter='')
    {
        $filterArray = json_decode(request('filter'));

        if (is_object($filterArray)) {

            $query = self::with(['policy','claimType','insuredPerson.addresses','agency.addresses'])->whereNotNull('n_PolicyNoId_FK');

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
        } else {
            // should we return anything if no filter?
            $query = self::whereNull('ClaimId_PK');
        }
        return $query;
    }

    /**
     * Claim Type
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimType()
    {
        return $this->belongsTo('App\Models\Api\v1\ClaimType', 'ClaimTypeId_FK')->withDefault();
    }

    /**
     * Policy of the claim
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function policy()
    {
        return $this->belongsTo('App\Models\Api\v1\Product', 'n_PolicyNoId_FK')->withDefault();
    }

    /**
     * Insured Person of the policy
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuredPerson()
    {
        return $this->belongsTo('App\Models\Api\v1\Person', 'n_InsuredPersonInfoId_FK')->withDefault();
    }

    /**
     * Agency of the policy
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agency()
    {
        return $this->belongsTo('App\Models\Api\v1\Person', 'n_AgencyPersoninfoId_FK')->withDefault();
    }

}
