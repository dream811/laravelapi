<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TbPabatchmaster extends Model
{
    protected $table = 'tb_pabatchmasters';
    public $timestamps = false;
    protected $primaryKey = 'n_PABatchMaster_PK';


    protected $fillable = [
        'n_PABatchMaster_PK', 's_PABatchNo', 'n_CompanyId_FK'
    ];

    static $successStatus = 200;
    static $errorStatus = 401;
    static $errorStatus_system = 400;
    static $returnOutput = [];

    public static function getBatchMastersDetails($params = ''){
        if(trim($params) > 0){
            
        }

        $QueryResult = DB::select("SELECT a.* FROM (SELECT tb_pabatchmasters.*, DATE_FORMAT(tb_pabatchmasters.d_BatchAccountingDate,'%m-%d-%Y') AS AccountingDate, DATE_FORMAT(tb_pabatchmasters.d_BatchStatusDate,'%m-%d-%Y') AS BatchStatusDate, tb_companies.s_CompanyName 
            ,(select count(*) from tb_pabatchdetails tb_pabatchdetails where tb_pabatchdetails.n_PABatchMaster_FK = tb_pabatchmasters.n_PABatchMaster_PK) as NoofEntries 
            ,(select SUM(n_FullAmount) from tb_pabatchdetails tb_pabatchdetails where tb_pabatchdetails.n_PABatchMaster_FK = tb_pabatchmasters.n_PABatchMaster_PK) as TotalAmt                                             
            FROM tb_pabatchmasters as tb_pabatchmasters
            LEFT JOIN tb_companies AS tb_companies 
               ON (tb_companies.n_CompanyId_PK = tb_pabatchmasters.n_CompanyId_FK)     
            ) AS a 
            ORDER BY a.s_PABatchNo DESC limit 100");

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
}
