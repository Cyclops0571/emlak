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
        if (Auth::check()) {
            return Redirect::to(__('route.home'));
        } else {
            return View::make('login.index');
        }
    }

    public function post_index()
    {
        $username = Input::get('username', '');
        $password = Input::get('password', '');

        /** @var MyUser $user */
        $user = MyUser::where('username', '=', $username)
            ->where('statusID', '=', eStatus::Active)
            ->first();
        $loginResult = Auth::attempt(array('username' => $username, 'password' => $password, 'statusID' => eStatus::Active, 'remember' => true));
        if ($loginResult) {
            $result =  array(
                "success" => true,
                "msg" => (string) __('common.login_success_redirect')
            );
        } else {
            $result =  array(
                "success" => false,
                "errmsg" => (string) __('error.login')
            );
        }
        return json_encode($result);
    }

    //forgotmypassword
    public function get_forgotmypassword()
    {
        return View::make('pages.forgotmypassword');
    }

    public function post_forgotmypassword()
    {
        $email = Input::get('Email');
        $rules = array(
            'Email' => 'required|email'
        );
        $v = Validator::make(Input::all(), $rules);
        if ($v->passes()) {
            /** @var User $user */
            $user = User::where('Email', '=', $email)
                ->where('StatusID', '=', 1)
                ->first();
            if ($user) {
                $pass = Common::generatePassword();
                /** @var User $s */
                $user->PWRecoveryCode = $pass;
                $user->PWRecoveryDate = new DateTime();
                $user->ProcessUserID = $user->UserID;
                $user->ProcessDate = new DateTime();
                $user->ProcessTypeID = eProcessTypes::Update;
                $user->save();

                $applications = $user->Application();
                $subject = __('common.login_email_subject');
                $msg = __('common.login_email_message', array(
                        'Application' => $applications[0]->Name,
                        'firstname' => $user->FirstName,
                        'lastname' => $user->LastName,
                        'username' => $user->Username,
                        'url' => Config::get('custom.url') . "/" . Config::get('application.language') . '/' . __('route.resetmypassword') . '?email=' . $user->Email . '&code=' . $pass
                    )
                );

                Common::sendEmail($user->Email, $user->FirstName . ' ' . $user->LastName, $subject, $msg);

                return "success=" . base64_encode("true") . "&msg=" . base64_encode(__('common.login_emailsent'));
            } else {
                return "success=" . base64_encode("false") . "&errmsg=" . base64_encode(__('common.login_emailnotfound'));
            }
        } else {
            return "success=" . base64_encode("false") . "&errmsg=" . base64_encode(__('common.detailpage_validation'));
        }
    }

    //resetmypassword
    public function get_resetmypassword()
    {
        $email = Input::get('email');
        $code = Input::get('code');

        $user = DB::table('User')
            ->where('Email', '=', $email)
            ->where('PWRecoveryCode', '=', $code)
            ->where('PWRecoveryDate', '>', DB::raw('ADDDATE(CURDATE(), INTERVAL -7 DAY)'))
            ->where('StatusID', '=', 1)
            ->first();

        if ($user) {
            return View::make('pages.resetmypassword');
        } else {
            return Redirect::to(__('route.login'))
                ->with('message', __('common.login_ticketnotfound'));
        }
    }

    public function post_resetmypassword()
    {
        $email = Input::get('Email');
        $code = Input::get('Code');
        $password = Input::get('Password');

        $rules = array(
            'Email' => 'required|email',
            'Code' => 'required',
            'Password' => 'required|min:4|max:12',
            'Password2' => 'required|min:4|max:12|same:Password'
        );
        $v = Validator::make(Input::all(), $rules);
        if (!$v->passes()) {
            $errMsg = $v->errors->first();
            return "success=" . base64_encode("false") . "&errmsg=" . base64_encode($errMsg);
        }


        $user = DB::table('User')
            ->where('Email', '=', $email)
            ->where('PWRecoveryCode', '=', $code)
            ->where('PWRecoveryDate', '>', DB::raw('ADDDATE(CURDATE(), INTERVAL -7 DAY)'))
            ->where('StatusID', '=', 1)
            ->first();

        if ($user) {
            $s = User::find($user->UserID);
            $s->Password = Hash::make($password);
            $s->ProcessUserID = $user->UserID;
            $s->ProcessDate = new DateTime();
            $s->ProcessTypeID = eProcessTypes::Update;
            $s->save();

            return "success=" . base64_encode("true") . "&msg=" . base64_encode(__('common.login_passwordhasbeenchanged'));
        } else {
            return "success=" . base64_encode("false") . "&errmsg=" . base64_encode(__('common.login_ticketnotfound'));
        }
    }

    public function get_logout()
    {
        if (Auth::check()) {
            $user = Auth::User();

            $sessionID = DB::table('Session')
                ->where('UserID', '=', $user->UserID)
                ->where('Session', '=', Session::instance()->session['id'])
                ->max('SessionID');

            if ((int)$sessionID > 0) {
                $s = Sessionn::find($sessionID);
                $s->LogoutDate = new DateTime();
                $s->ProcessUserID = $user->UserID;
                $s->ProcessDate = new DateTime();
                $s->ProcessTypeID = eProcessTypes::Update;
                $s->save();
            }
            Auth::logout();
        }

        setcookie("loggedin", "false", time(), "/");

        return Redirect::to(__('route.login'))
            ->with('message', __('common.login_succesfullyloggedout'));
    }
}