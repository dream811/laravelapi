<?php

namespace App\Models\Api\v1;

use App\Models\Api\v1\ManageAccountingModel;
use App\Models\Api\v1\TbPabatchmaster;

class AccModel 
{

     

    public function Get_AccountTypes($Params='')
    {
        $allaccounts = ManageAccountingModel::Accounts_Type_List($Params);
        return response()->json($allaccounts);
    }

    public function Save_AccountType($Params='')
    {
        $accounts_type = ManageAccountingModel::Save_AccountType($Params);
        return response()->json($accounts_type);

    }

    public function getBatchDetails($params = ''){
        $batchDetails = TbPabatchmaster::getBatchMastersDetails($params);
        return response()->json($batchDetails);
    }
}
