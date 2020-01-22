<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;
use Validator;


class ManageModuleModel extends Model
{
    protected $table = 'tb_gfs_usermodule';
    public $timestamps = false;
    protected $primaryKey = 'n_UserModule_PK';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'n_UserModule_PK', 's_UserModuleName', 's_UserModuleCode'
    ];

    static $successStatus = 200;
    static $errorStatus = 401;
    static $errorStatus_system = 400;
    static $returnOutput = [];
    

    public static function Modules_List($Params='')
    {        
        if(trim($Params) > 0)
        {
            $QueryResult = DB::select("select * from tb_gfs_usermodule where n_UserModule_PK = :n_UserModule_PK", ["n_UserModule_PK" => $Params]);
        }else{
            $QueryResult = DB::select('select * from tb_gfs_usermodule order by s_UserModuleName ASC');
        }
        
        //dd(count($QueryResult));
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

    public static function Save_Modules($Params='')
    {   
        //validate fields
        $validatorReturn = Validator::make($Params->all(), [            
            'ModuleName'=>'required',
            'ModuleCode'=>'required'            
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
                's_UserModuleName'=>$Params->input('ModuleName'),
                "s_UserModuleCode"=>$Params->input('ModuleCode')
            );
            $InsertedRecord= self::create([
                's_UserModuleName'=>$Params->input('ModuleName'),
                "s_UserModuleCode"=>$Params->input('ModuleCode')
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
