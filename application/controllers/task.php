<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 18.07.2016
 * Time: 17:02
 */
class Task_Controller extends Controller
{
    public $restful = true;
    public function __construct()
    {
        parent::__construct();
    }

    public function get_pushNotification() {
        \Laravel\CLI\Command::run(array('notification'));
    }

}