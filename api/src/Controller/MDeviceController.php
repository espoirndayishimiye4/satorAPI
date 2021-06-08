<?php
namespace Src\Controller;

use Src\Models\MDeviceModel;
use Src\System\Token;

class MDeviceController {

    private $db;
    private $requestMethod;
    private $seller_id;

    private $mDeviceModel;
    private $action;
    public function __construct($db, $requestMethod, $seller_id)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->seller_id = $seller_id;

        $this->mDeviceModel = new MDeviceModel($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                    if (isset($this->seller_id)) {
                        $response = $this->getSeller($this->seller_id);
                    } else {
                       
                            $response = $this->getAllMDevice();
                       
                    }
                break;
            
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllMDevice()
    {
        $result = $this->mDeviceModel->findAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }





    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = json_encode(["status" => 404, "msg" =>"Not Found"]);
        return $response;
    }


}