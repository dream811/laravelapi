<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Models\Api\v1\Claim;

use App\Http\Requests\ClaimRequest;
use App\Http\Resources\ClaimResource;


class ClaimController extends Controller
{
    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Claim::getList(request('filter', ''))
                    ->orderBy(request('order_by','Inserted_Date'),request('order','DESC'));

        return ClaimResource::collection($query->paginate(request('per_page', 25)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClaimRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClaimRequest $request)
    {
        $claim = Claim::create($request->all());
        return new ClaimResource($claim);
    }

    /**
     * Return the specified resource.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function show(Claim $claim)
    {
        return new ClaimResource($claim);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClaimRequest  $request
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function update(ClaimRequest $request, Claim $claim)
    {
        $claim->update($request->all());
        return new ClaimResource($claim);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function destroy(Claim $claim)
    {
        $claim->delete();
        return response()->json(['result'=>'deleted'], 204);
    }
}
