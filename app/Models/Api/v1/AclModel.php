<?php

namespace App\Models\Api\v1;

use App\Models\Api\v1\ManageModuleModel;
use App\Models\Api\v1\TbPabatchmaster;

class AclModel 
{

     

    public function Get_Modules($Params='')
    {
        $users = ManageModuleModel::Modules_List($Params);
        return response()->json($users);
    }

    public function Save_Modules($Params='')
    {
        $users = ManageModuleModel::Save_Modules($Params);
        return response()->json($users);

    }

    public function getBatchDetails($params = ''){
        $batchDetails = TbPabatchmaster::getBatchMastersDetails($params);
        return response()->json($batchDetails);
    }
}
