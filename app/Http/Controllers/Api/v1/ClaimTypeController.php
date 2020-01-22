<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Models\Api\v1\ClaimType;

use App\Http\Requests\ClaimTypeRequest;
use App\Http\Resources\ClaimTypeResource;

class ClaimTypeController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClaimTypeResource::collection(ClaimType::orderBy('Claim_Type_Code','ASC'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClaimTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClaimTypeRequest $request)
    {
        $claim_type = ClaimType::create($request->all());
        return new ClaimTypeResource($claim_type);
    }

    /**
     * Return the specified resource.
     *
     * @param  \App\ClaimType  $claim_type
     * @return \Illuminate\Http\Response
     */
    public function show(ClaimType $claim_type)
    {
        return new ClaimTypeResource($claim_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClaimTypeRequest  $request
     * @param  \App\ClaimType  $claim_type
     * @return \Illuminate\Http\Response
     */
    public function update(ClaimTypeRequest $request, ClaimType $claim_type)
    {
        $claim_type->update($request->all());
        return new ClaimTypeResource($claim_type);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClaimType  $claim_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClaimType $claim_type)
    {
        $claim_type->delete();
        return response()->json(['result'=>'deleted'], 204);
    }
}
