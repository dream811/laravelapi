<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return [
        //     'first_name' => $this->Username,
        //     'last_name' => $this->Email,
        // ];
        return parent::toArray($request);
    }
}
