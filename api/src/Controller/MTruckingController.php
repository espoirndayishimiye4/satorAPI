<?php
namespace Src\Controller;

use Src\Models\MTruckingModel;
use Src\System\Token;

class MTruckingController {

    private $db;
    private $requestMethod;
    private $serialnumber;

    private $MTruckingModel;
    private $action;
    public function __construct($db, $requestMethod, $serialnumber)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->serialnumber = $serialnumber;

        $this->MTruckingModel = new MTruckingModel($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                    if (isset($this->serialnumber)) {
                        $response = $this->getTruck($this->serialnumber);
                    } else {
                        
                            $response = $this->getTruck($this->serialnumber);
                       
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



    private function getTruck($id)
    {
        $result = $this->MTruckingModel->find($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
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