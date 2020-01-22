<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Resources\AgencyResource;
use App\Http\Resources\AgencyResourceCollection;
use App\Models\Api\v1\TbPersonInfo;


class AgencyController extends ApiController
{
    //
    public function index(): AgencyResourceCollection
    {
        return new AgencyResourceCollection(TbPersonInfo::paginate());
    }

    public function show($id): AgencyResource
    {
        
        $person = TbPersonInfo::where('n_PersonInfoId_PK', $id)->firstOrFail();
        // print_r($person);
        return new AgencyResource($person);
    }

    public function showDetail($id): AgencyResource
    {
        
        $person = TbPersonInfo::where('n_PersonInfoId_PK', $id)->firstOrFail();
        return new AgencyResource($person);
    }

    public function store(Request $request)
    {
        $request->validate([
            'agency_code' => 'required',
            'agency_name' => 'required',
            'dba_name' => 'required',
            'agency_status' => 'required',
            'eft_payee_name' => 'required',
        ]);
        // Warning: Data isn't being fully sanitized yet.
        try {
            $person = TbPersonInfo::create([
                's_PersonUniqueId' => request('agency_code'),
                's_FullLegalName' => request('agency_name'),
                's_DBAName' => request('dba_name'),
                's_PersonStatusCode' => request('agency_status'),
                's_PayeeName' => request('eft_payee_name'),
            ]);
            return response()->json([
                'status' => 201,
                'message' => 'Resource created.',
                'id' => $person->n_PersonInfoId_PK
            ], 201);
        } catch (Exception $e) {
            return $this->responseServerError('Error creating resource.');
        }
    }

    public function destroy($id)
    {
        $person = TbPersonInfo::where('n_PersonInfoId_PK', $id)->firstOrFail();

        // // User can only delete their own data.
        // if ($todo->user_id !== $user->id) {
        //     return $this->responseUnauthorized();
        // }

        try {
            $person->delete();
            return $this->responseResourceDeleted();
        } catch (Exception $e) {
            return $this->responseServerError('Error deleting resource.');
        }
    }
}
