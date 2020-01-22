<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;
use Validator;


class ManageAccountingModel extends Model
{
    protected $table = 'tb_gfs_account_type';
    public $timestamps = false;
    protected $primaryKey = 'Account_Type_ID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'Account_Type_Name', 'Account_Type_No','Account_Type_Class','Account_Type_Status'
    ];

    static $successStatus = 200;
    static $errorStatus = 401;
    static $errorStatus_system = 400;
    static $returnOutput = [];
    

    public static function Accounts_Type_List($Params='')
    {        
        if(trim($Params) > 0)
        {
            $QueryResult = DB::select("select * from tb_gfs_account_type where n_UserModule_PK = :n_UserModule_PK", ["n_UserModule_PK" => $Params]);
        }else{
            $QueryResult = DB::select('select * from tb_gfs_account_type order by Account_Type_ID ASC');
        }
        
        //dd(count($QueryResult)); die;
        if (count($QueryResult) > 0 )
        {
            //throw new Exception('WOW');
            self::$returnOutput['status'] = true;
            self::$returnOutput['code'] = self::$successStatus;
            self::$returnOutput['returnObject'] = $QueryResult;
            self::$returnOutput['message'] = "Got Successfully";
        }else{
            self::$returnOutput['status'] = true;
            self::$returnOutput['code'] = self::$successStatus;
            self::$returnOutput['returnObject'] = null;
            self::$returnOutput['message'] = 'No Record Found';
        }
        return self::$returnOutput;
    }

    public static function Save_AccountType($Params='')
    {   
        //validate fields
        $validatorReturn = Validator::make($Params->all(), [            
            'Account_Type_Name'=>'required',
            'Account_Type_Class'=>'required',
            'Account_Type_No'   =>'required',
			'Account_Type_Status' =>'required'
			
        ]);
        if ($validatorReturn->fails())    {
            return response()->json(['error'=> $validatorReturn->errors()], self::$errorStatus);
        } 
        
        //check database validation
        $QueryResult = DB::select("select count(*) as Count from tb_gfs_usermodule where s_UserModuleName = '".$Params->input('ModuleName')."' and s_UserModuleCode = '".$Params->input('ModuleCode')."'");
        if($QueryResult[0]->Count > 0)
        {
            self::$returnOutput['status'] = true;
            self::$returnOutput['code'] = self::$successStatus;
            self::$returnOutput['errorStatus'] = true;
            self::$returnOutput['message'] = "Record is already exist!";
        }else{
            //save record
            $data=array(
                'Account_Type_Name'=>$Params->input('Account_Type_Name'),
                "Account_Type_No"=>$Params->input('Account_Type_No'),
				"Account_Type_Class"=>$Params->input('Account_Type_Class'),
				"Account_Type_Status"=>$Params->input('Account_Type_Status'),
				
				
            );
            $InsertedRecord= self::create([
                'Account_Type_Name'=>$Params->input('Account_Type_Name'),
                "Account_Type_No"=>$Params->input('Account_Type_No'),
				"Account_Type_Class"=>$Params->input('Account_Type_Class'),
				"Account_Type_Status"=>$Params->input('Account_Type_Status'),
            ]);
            //echo $lastInsertedId= $InsertedRecord->id;
            //dd($lastInsertedId);
            self::$returnOutput['status'] = true;
            self::$returnOutput['code'] = self::$successStatus;
            self::$returnOutput['errorStatus'] = false;
            self::$returnOutput['message'] = "Record is added successfully.";
        }

        
        return self::$returnOutput;
    }
}
