<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 19.07.2016
 * Time: 12:05
 * @property  string taskName
 * @property  string taskStatus
 * @property  string errorStackTrace
 */
class MyTask extends Eloquent
{
    public static $timestamps = true;
    public static $table = 'Task';
    public static $key = 'taskID';
}