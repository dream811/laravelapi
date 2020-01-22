<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;


class PassportAuthTestingController extends Controller
{

    public $successStatus = 200;
    public $errorStatus = 401;
    public $errorStatus_system = 400;

    public function register(Request $request)
    {
        //return bcrypt($request['Password']);
        //validate fields
        $validatorReturn = Validator::make($request->all(), [            
                'Username'=>'required|max:55',
                'Email'=>'email|required',
                'Password'=>'required',
            ]);

        if ($validatorReturn->fails())    {
            return response()->json(['error'=> $validatorReturn->errors()], $this->errorStatus);
        }

        $input = $request->all();
        $input['Password'] = bcrypt($input['Password']);//update password with increpted value
        //$input['Password'] = Hash::make($input['Password']);//update password with increpted value
        $user = User::create($input);//insert into table
        //Success collection
        $success['token'] = $user->createToken('GFSToken')->accessToken;
        //$user->createToken('authToken')->access_token;
        $success['Username'] = $user->Username;
        return response()->json(['success'=>$success, $this->successStatus]);

    }

    public function login(Request $request)
    {
        //dd(bcrypt($request->Password));
        //validate fields
        $validator = Validator::make($request->all(), [                            
                'Username'=>'required',
                'Password'=>'required'
            ]);
        if ($validator->fails())    {
            return response()->json(['error'=> $validator->errors()], $this->errorStatus);
        }


        $responseData['status'] = true;
        $responseData['message'] = '';
        $responseData['code'] = $this->successStatus;
        $responseData['returnObject'] = [];

        try{
            if(Auth::attempt(['Username'=> $request->Username, 'password'=> $request->Password], true))
            {                
                //dd(Auth::id());
                $userDetail = User::find(Auth::id());
                $responseData['status'] = $this->successStatus;
                $responseData['code'] = $this->successStatus;
                $responseData['access_token'] = Auth::user()->createToken('GFSUserToken')->accessToken;
                $responseData['token_type'] = 'bearer';
                $responseData['returnObject'] = $userDetail;
                //$responseData['userData'] = Auth::user();
                $responseData['message'] = 'User has been Successfully Logged in';
            }
            else
            {
                $responseData['status'] = $this->errorStatus;
                $responseData['code'] = $this->errorStatus;
                $responseData['message'] = 'Invalid Credential';                
                $responseData['errors'] = 'Invalid Credential';                
            }
        }
        catch(Exception $exp)
        {
            $responseData['status'] = $this->errorStatus_system;
            $responseData['code'] = $this->errorStatus_system;
            $responseData['errors'] = $exp->getMessage();                
            
            return response()->json($responseData, $responseData['code']);
        }

        return response()->json($responseData, $responseData['code']);

    }

    public function getUserDetail(Request $request)
    {
        //validate fields
        $user = Auth::user();

        $responseData['status'] = $this->successStatus;
        $responseData['code'] = $this->successStatus;
        $responseData['errors'] = '';                
        $responseData['message'] = '';                
        $responseData['returnObject'] = $user;
        
        return response()->json($responseData, $responseData['code']);        
    }


    
    
}
