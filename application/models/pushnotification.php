<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 14.07.2016
 * Time: 17:51
 * @property int pushNotificationID
 * @property int myUserID
 * @property string notificationText
 * @property int statusID
 */
class PushNotification extends Eloquent
{
    public static $timestamps = true;
    public static $table = 'PushNotification';
    public static $key = 'pushNotificationID';
}