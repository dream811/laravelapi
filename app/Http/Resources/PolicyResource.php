<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PolicyResource extends JsonResource
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
        $res['insuredPerson'] = $this->insuredPerson;
        //$res['claims'] = $this->claims;
        $res['claims_ids'] = array_map(function($item){
            return [ "id"=>$item['ClaimId_PK'], "Claim_No" => $item['Claim_No']];
        }, $this->claims->toArray());
        return $res;
    }
}
