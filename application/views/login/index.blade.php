@layout('master')

@section('content')
    <style type="text/css">
        .social-media{
            /*margin-top: 22px;*/
        }
        .g-button{
            background: #dd4b39 !important;
            color: white !important;
        }
        .g-button i{
            font-size: 1.4em;
        }
        .fb-button{
            background: #3b5998 !important;
            color: white !important;
            font-family: "lucida grande", tahoma, verdana, arial, sans-serif;
            /*margin-top: 22px;*/
        }
        .fb-button i{
            font-size: 1.4em;
            vertical-align: middle;
        }
        .noTouch{
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            pointer-events: none;
        }

        .loginBlock{border-radius:13px;}
    </style>
    <?php
    $cookie = Cookie::get('DSCATALOG_USERNAME', '');
    ?>
    {{ Form::open(\Laravel\URL::to('loginPost'), 'POST') }}
    {{ Form::token() }}
    <div class="container">
        <div class="login-block">
            <div class="block bg-light loginBlock">
                <div class="head">
                    <div class="user">
                        LOGO 571571
                        <img src="/img/myLogo3.png">
                    </div>
                </div>
                <div class="content controls npt">
                    <div class="form-row user-change-row" style="display: block;">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="icon-user" id="login-icon-user" style="font-size:15px;"></span>
                                </div>
                                <input class="form-control txt required" type="text"
                                       placeholder="{{ __('common.users_username') }}" id="Username" name="Username"
                                       onKeyPress="return sForm.bindEnterKey(event, sUser.login);"
                                       value="{{ $cookie }}"/>
                                {{ $errors->first('Username', '<p class="error">:message</p>') }}
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="icon-key" id="login-icon-key"></span>
                                </div>
                                <input type="password" class="form-control txt required" id="Password" name="Password" onKeyPress="return sForm.bindEnterKey(event, sUser.login);" placeholder="{{ __('common.users_password') }}"/>
                                {{ $errors->first('Password', '<p class="error">:message</p>') }}
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="checkbox" style="padding-left:0;">
                                <label style="font-size:14px;"><input type="checkbox" name="Remember" {{ (strlen($cookie) > 0 ? ' checked="checked"' : '') }} />{{ __('common.login_remember') }}</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="button" class="btn btn-mini" name="login" id="login" value="{{ __('common.login_button') }}" onclick="sUser.login();" />
                        </div>
                    </div>
                    <div class="form-row"  style="margin-bottom:0;"><!-- border-bottom:1px solid #202020; height:35px; -->
                        <div class="col-md-12">
                            <div style="text-align:center"><u><a href="{{URL::to(__('route.forgotmypassword'))}}">{{ __('common.login_forgotmypassword') }}</a></u></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection