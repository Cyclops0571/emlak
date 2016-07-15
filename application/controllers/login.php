<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 11.07.2016
 * Time: 12:00
 */
class Login_Controller extends Controller
{
    public $restful = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_index() {
        return Laravel\View::make('login.index');
    }

}