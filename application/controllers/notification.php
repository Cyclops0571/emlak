<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 21.07.2016
 * Time: 12:18
 */
class Notification_Controller extends Controller
{
    public function __construct()
    {
        $this->restful = true;
        parent::__construct();
    }

    public function post_save() {
        $rules = array();
        $rules["message"] = "required";
        $v = Validator::make(Input::all(), $rules);
        if($v->fails()) {
            return json_encode($v->errors->first());
        }
        /** @var MyUser $user */
        $user = Auth::user();
        $notification = new PushNotification();
        $notification->myUserID = $user->myUserID;
        $notification->notificationText = Input::get('message');
        $notification->remoteEstateID = Input::get('remoteEstateID', 0);
        $notification->save();

        $tokens = ClientDeviceToken::getConsultantTokens($user->myUserID);
        foreach ($tokens as $token) {
            //save to push notification
            $notificationDevice = new PushNotificationDevice();
            $notificationDevice->pushNotificationID = $notification->pushNotificationID;
            $notificationDevice->clientDeviceTokenID = $token->clientDeviceTokenID;
            $notificationDevice->sent = 0;
            $notificationDevice->errorCount = 0;
            $notificationDevice->statusID = eStatus::Active;
            $notificationDevice->save();
        }

        return MyResponse::success();
    }
}