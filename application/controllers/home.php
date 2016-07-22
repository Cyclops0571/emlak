<?php

class Home_Controller extends Controller
{
    public $restful = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_index()
    {
        $remoteService = new Remoteservice();
        /** @var MyUser $user */
        $user = Auth::user();
        $parameters = array();
        $parameters["UserId"] = $user->remoteID;
        $estateList = $remoteService->estateList($parameters);
        $data = array();
        $data["estateList"] = $estateList;
        return View::make('home.index', $data);
    }

    public function post_logout() {
        Auth::logout();
        return MyResponse::success();
    }
}
