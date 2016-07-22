<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 14.07.2016
 * Time: 17:56
 */
class Service_Controller extends Controller
{
    public $restful = true;
    /**
     * @var Remoteservice
     */
    private $remoteService;
    public function __construct()
    {
        $this->remoteService = new Remoteservice();
        parent::__construct();
    }

    public function post_token()
    {
        //android ios icin tip
        //consultantID gelecek
        //deviceToken gelecek
        $rules = array(
            "UserId" => 'required|integer|exists:MyUser,remoteID',
            "Type" => 'required|in:ios,android',
            "DeviceToken" => 'required',
        );
        $v = \Laravel\Validator::make(\Laravel\Input::all(), $rules);
        if ($v->fails()) {
            return MyResponse::error($v->errors->first());
        }
        $remoteEnvironmentID = 1;
        $remoteID = \Laravel\Input::get("UserId");
        $type = \Laravel\Input::get("Type");
        $deviceToken = \Laravel\Input::get("DeviceToken");

        /** @var MyUser $user */
        $user = MyUser::where('remoteEnvironmentID', '=', $remoteEnvironmentID)
            ->where('remoteID', '=', $remoteID)->where('statusID', '=', eStatus::Active)->first();

        /** @var ClientDeviceToken $clientDeviceToken */
        $clientDeviceToken = ClientDeviceToken::where('myUserID', '=', $user->myUserID)
            ->where('deviceToken', '=', $deviceToken)
            ->first();
        if(!$clientDeviceToken) {
            $clientDeviceToken = new ClientDeviceToken();
            $clientDeviceToken->statusID = eStatus::Active;
            $clientDeviceToken->myUserID = $user->myUserID;
            $clientDeviceToken->deviceToken = $deviceToken;
            $clientDeviceToken->deviceType = $type == 'ios' ? eDeviceTypes::ios : eDeviceTypes::android;
            $clientDeviceToken->save();
        }
        return MyResponse::success();
    }

    public function post_userDetail($id)
    {
        echo $this->remoteService->userDetail($id);
    }

    public function post_officeProperties()
    {
        $rules = array("UserId" => "required|integer");
        $validator = Laravel\Validator::make(\Laravel\Input::all(), $rules);
        if (!$validator->passes()) {
            return json_encode(array('error' => $validator->errors->first()));
        }

        $parameters = Laravel\Input::all();
        $estateList = $this->remoteService->estateList($parameters);
        return json_encode($estateList->items);
    }


    public function post_userList()
    {
        return $this->remoteService->userList();
    }


    public function post_propertyDetail($id)
    {
        return $this->remoteService->estateDetail($id);
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