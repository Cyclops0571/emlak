<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 14.07.2016
 * Time: 15:57
 *
 * @property int clientDeviceTokenID
 * @property int myUserID
 * @property int clientID
 * @property string deviceToken
 * @property string deviceType
 * @property int statusID
 */
class ClientDeviceToken extends Eloquent
{
    public static $timestamps = true;
    public static $table = 'ClientDeviceToken';
    public static $key = 'clientDeviceTokenID';

    /**
     * @param int $myUserId
     * @return ClientDeviceToken[]
     */
    public static function getConsultantTokens($myUserId) {
        return ClientDeviceToken::where('myUserID', '=', $myUserId)->where('statusID', '=', eStatus::Active)->get();
    }
}