<?php
/**
 * @property int $pushNotificationID Description
 * @property int $clientDeviceTokenID Description
 * @property int $sent Description
 * @property int $errorCount Description
 * @property int $lastErrorDetail Description
 * @property int $statusID Description
 */
class PushNotificationDevice extends Eloquent
{
	public static $timestamps = true;
	public static $table = 'PushNotificationDevice';
	public static $key = 'pushNotificationDeviceID';
}