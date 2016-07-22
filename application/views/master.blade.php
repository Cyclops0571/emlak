<!DOCTYPE html>
<html>
<head>
    <title>Galepress Emlak</title>
    <!-- Meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="tr"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" content="Serdar Saygılı"/>
    <meta name="copyright" content="Gale Press Technology"/>
    <meta name="company" content="Detay Danışmanlık Bilgisayar Hiz. San. ve Dış Tic. A.Ş."/>
    <link rel="shortcut icon" href="/website/img/favicon2.ico">

    <!-- CSS -->
    <link href="/css/mobilestyle.css?v={{APP_VER}}" type="text/css" media="screen" rel="stylesheet">
    <link href="/css/bootstrap.min.css?v={{APP_VER}}" type="text/css" media="screen" rel="stylesheet">
    <link href="/css/statusbar.css?v={{APP_VER}}" type="text/css" media="screen" rel="stylesheet">
    <link href="/css/font-awesome.min.css?v={{APP_VER}}" type="text/css" media="screen" rel="stylesheet">
    <link href="/css/select2.min.css?v={{APP_VER}}" rel="stylesheet"/>

    <!-- Javascript -->
    @include('javascript.route')
    {{ HTML::script('js/jquery-2.1.4.min.js'); }}
    {{ HTML::script('js/jquery-ui-1.10.4.custom.min.js'); }}
    {{ HTML::script('js/bootstrap.min.js'); }}
    {{ HTML::script('js/select2.min.js'); }}
    {{ HTML::script('js/generic.js?v=' . APP_VER); }}
    {{ HTML::script('js/user.js?v=' . APP_VER); }}
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <img src="/img/shelterLogo.png" class="myLogo">
        </div>
    </div>
    @_yield('content')

    <?php if(Auth::user()): ?>
    <div class="row margin-top-50">
        <div class="col-md-12">
            <input type="button" class="btn btn-danger btn-lg btn-block" value="Çıkış" onclick="sUser.logout();">
        </div>
    </div>
    <?php endif; ?>
</div>
<script type="text/javascript">
    $('select').select2();
</script>
</body>
</html>