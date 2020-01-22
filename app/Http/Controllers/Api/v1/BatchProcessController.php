<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\v1\AclModel;

class BatchProcessController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;
    public $errorStatus_system = 400;

    public $AclModel = null;
    function __construct()
    {
        $this->AclModel = new AclModel();
    }

    public function showDetails($params = ''){
        $resultArray = $this->AclModel->getBatchDetails($params);
        return $resultArray;
    }
}
