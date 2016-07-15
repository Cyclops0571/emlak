<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 14.07.2016
 * Time: 15:57
 *
 * @property int myUserID
 * @property int remoteEnvironmentID
 * @property int remoteID
 * @property string username
 * @property string password
 * @property string firstname
 * @property string lastname
 * @property string email
 * @property int statusID
 */
class MyUser extends Eloquent
{
    public static $timestamps = true;
    public static $table = 'MyUser';
    public static $key = 'muUserID';
}