<?php
class UserController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();

                /*$intLimit = 1;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }*/
				
				$url_components = parse_url($_SERVER['REQUEST_URI']);
				parse_str($url_components['query'], $arrQueryStringParams);
				
				$email = 'maribel1';
                if (isset($arrQueryStringParams['email']) && $arrQueryStringParams['email']) {
                    $email = $arrQueryStringParams['email'];
                }
				
				//$email = $arrQueryStringParams[0];

                $arrUsers = $userModel->getUsers($email); //$intLimit);
				$out = array_values($arrUsers);
                $responseData = json_encode(array('results' => $out)); //JSON_FORCE_OBJECT);  //$arrUsers
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}

?>