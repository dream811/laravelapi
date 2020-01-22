<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Models\Api\v1\Policy;

use App\Http\Requests\PolicyRequest;
use App\Http\Resources\PolicyResource;

class PolicyController extends Controller
{
    /**
     * Returns a filtered list of the policies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Policy::getList(request('filter', ''))
                     ->orderBy(request('order_by','d_CreatedDate'),request('order','DESC'));
 
        return PolicyResource::collection($query->paginate(request('per_page', 100)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PolicyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PolicyRequest $request)
    {
        $policy = Policy::create($request->all());
        return new PolicyResource($policy);
    }

    /**
     * Return the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        return new PolicyResource($policy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(PolicyRequest $request, Policy $policy)
    {
        $policy->update($request->all());
        return new PolicyResource($policy);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        $policy->delete();
        return response()->json(['result'=>'deleted'], 204);
    }
}
