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
    public function __construct()
    {
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
}