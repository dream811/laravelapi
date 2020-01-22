<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Models\Api\v1\Person;

use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonResource;

class PersonController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Person::getList(request('filter', ''))
                     ->orderBy(request('order_by','s_FullLegalName'),request('order','ASC'));
 
        return PersonResource::collection($query->paginate(request('per_page', 100)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PersonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        $person = Person::create($request->all());
        return new PersonResource($person);
    }

    /**
     * Return the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return new PersonResource($person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PersonRequest  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, Person $person)
    {
        $person->update($request->all());
        return new PersonResource($person);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return response()->json(['result'=>'deleted'], 204);
    }
}
