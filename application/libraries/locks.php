<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 15.07.2016
 * Time: 19:36
 */
class Locks
{
    /**
     * Locks the push notification lock file.
     */
    public static function pushNotification() {

        if(Laravel\Request::env() == ENV_LIVE) {
            self::locked(path('app') . 'lock/emlak_push_notification_test.lock');
        } else {
            self::locked(path('app') . 'lock/emlak_push_notification.lock');
        }
    }

    private static function locked($path) {
        $fp = fopen($path, 'r+');
        /* Activate the LOCK_NB option on an LOCK_EX operation */
        while (!flock($fp, LOCK_EX | LOCK_NB)) {
            echo 'Unable to obtain lock';
            sleep(10);
        }
    }
}