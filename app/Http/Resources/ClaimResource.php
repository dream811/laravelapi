<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClaimResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $res = parent::toArray($request);
        $res['policy'] = $this->policy;
        $res['insuredPerson'] = $this->insuredPerson->with('adresses');
        //$res['insuredPersonAdresses'] = $this->insuredPerson->adresses;
        $res['agency'] = $this->agency;
        $res['claims'] = $this->policy->claims;
        return $res;
    }
}
