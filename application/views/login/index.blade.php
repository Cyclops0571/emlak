@layout('master')

@section('content')
    <?php
    $cookie = Cookie::get('DSCATALOG_USERNAME', '');
    ?>
    {{ Form::open(\Laravel\URL::to('loginPost'), 'POST') }}
    {{ Form::token() }}

        <div class="row margin-top-10">
            <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="icon-user" id="login-icon-user" style="font-size:15px;"></span>
                    </div>
                    <input class="form-control txt required" type="text"
                           placeholder="{{ __('common.users_username') }}" name="username"
                           onKeyPress="return sForm.bindEnterKey(event, sUser.login);"
                           value="{{ $cookie }}"/>
                    {{ $errors->first('Username', '<p class="error">:message</p>') }}
                </div>
            </div>
        </div>
        <div class="row margin-top-10">
            <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="icon-key" id="login-icon-key"></span>
                    </div>
                    <input type="password" class="form-control txt required" name="password"
                           onKeyPress="return sForm.bindEnterKey(event, sUser.login);"
                           placeholder="{{ __('common.users_password') }}"/>
                    {{ $errors->first('Password', '<p class="error">:message</p>') }}
                </div>
            </div>
        </div>
        <div class="row margin-top-10">
            <div class="col-md-12 ">
                <input type="button" class="btn btn-primary btn-lg btn-block" name="login" id="login"
                       value="{{ __('common.login_button') }}" onclick="sUser.login();"/>
            </div>
        </div>
    {{ Form::close() }}
@endsection