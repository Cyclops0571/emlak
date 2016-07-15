<?php

class Home_Controller extends Controller
{
    public $restful = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_home()
    {
        $token = $this->serviceGetToken();
        echo $this->getUserList($token);
    }

    public function post_home()
    {
        echo "indexe dustum...";
        exit;
    }

    public function post_userDetail($id)
    {
        $token = $this->serviceGetToken();
        echo $this->getUserDetail($token, $id);
    }

    public function post_officeProperties()
    {
        $rules = array("UserId" => "required|integer");
        $validator = Laravel\Validator::make(\Laravel\Input::all(), $rules);
        if (!$validator->passes()) {
            return json_encode(array('error' => $validator->errors->first()));
        }

        $parameters = Laravel\Input::all();
        $token = $this->serviceGetToken();

        $estateList = new EstateList($token, $parameters);
        return json_encode($estateList->items);
    }

    private function serviceGetToken()
    {
        $credentials = array();

        // Hürdoğan Çalgır "UserBaseId":1501
        $credentials["UserName"] = 'GhoUser';
        $credentials["Password"] = 'Gho$UserData#api2016';
        $credentials["UserName"] = 'GhoOfficeUser';
        $credentials["Password"] = 'Gho$OfficeData#api2016';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, Emlakurl::token);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credentials));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return new Token($response);
    }

    private function getUserList(Token $token)
    {
        $parameters = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, Emlakurl::UserList);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $token->getBearer()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    private function getUserDetail(Token $token, $id)
    {
        $parameters = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, str_replace('(:num)', $id, Emlakurl::UserDetail));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $token->getBearer()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function post_propertyDetail($id)
    {
        $token = $this->serviceGetToken();
        $parameters = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, str_replace('(:num)', $id, Emlakurl::EstateDetail));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $token->getBearer()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function post_applicationDetail()
    {
        $rules = array(
            "UserId" => 'required|integer',
        );
        $v = \Laravel\Validator::make(\Laravel\Input::all(), $rules);
        if ($v->fails()) {
            return MyResponse::error($v->errors->first());
        }
        //571571
        $detailLink = array();
        $detailLink["android"] = "Playstore Linki gelecek.";
        $detailLink["ios"] = "App Store Linki gelecek.";
        return json_encode($detailLink);
    }
}
