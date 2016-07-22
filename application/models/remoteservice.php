<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 21.07.2016
 * Time: 18:15
 */
class Remoteservice
{

    /** @var Token */
    private $token;

    public function __construct()
    {
        $this->token = $this->serviceGetToken();
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

    public function estateList($parameters) {
        return new EstateList($this->token, $parameters);
    }
    public function userList() {
        $parameters = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, Emlakurl::UserList);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->token->getBearer()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function userDetail($id) {
        $parameters = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, str_replace('(:num)', $id, Emlakurl::UserDetail));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->token->getBearer()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    public function estateDetail ($id) {
        $parameters = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, str_replace('(:num)', $id, Emlakurl::EstateDetail));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->token->getBearer()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}