<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>{{ config('laragammu.appname') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        {!! Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}
        {!! Html::style('assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
        {!! Html::style('assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('assets/global/plugins/uniform/css/uniform.default.css') !!}
        {!! Html::style('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
        {!! Html::style('assets/global/plugins/select2/css/select2.min.css') !!}
        {!! Html::style('assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}
        {!! Html::style('assets/global/css/components-md.min.css') !!}
        {!! Html::style('assets/global/css/plugins-md.min.css') !!}
        {!! Html::style('assets/pages/css/login-4.min.css') !!}

        <link rel="shortcut icon" href="favicon.ico" /> </head>

    <body class=" login">
        <div class="logo">
            <a href="#">
                {!! Html::image('assets/pages/img/logo-big.png') !!} 
            </a>
        </div>
        
        <div class="content">
            {!! Form::open(array('url' => 'authenticate', 'class' => 'login-form')) !!}
                <h3 class="form-title">Login to your account</h3>
                @include('layouts.partials.alert')
                @include('layouts.partials.validation')
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        {!! Form::text('user', null, array('placeholder' => 'Username atau E-mail', 'class' => 'form-control placeholder-no-fix')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        {!! Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control placeholder-no-fix')) !!}
                    </div>
                </div>
                <div class="form-actions">
                    {!! Form::submit('Login', array('class' => 'btn green pull-right')) !!}
                </div>
            {!! Form::close() !!}
        </div>
        
        <div class="copyright"> Developed by Budi - {{ config('laragammu.appname') }} {{ date('Y') }}</div>
        
        {!! Html::script('assets/global/plugins/jquery.min.js') !!}
        {!! Html::script('assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('assets/global/plugins/js.cookie.min.js') !!}
        {!! Html::script('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
        {!! Html::script('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
        {!! Html::script('assets/global/plugins/jquery.blockui.min.js') !!}
        {!! Html::script('assets/global/plugins/uniform/jquery.uniform.min.js') !!}
        {!! Html::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
        {!! Html::script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}
        {!! Html::script('assets/global/plugins/jquery-validation/js/additional-methods.min.js') !!}
        {!! Html::script('assets/global/plugins/select2/js/select2.full.min.js') !!}
        {!! Html::script('assets/global/plugins/backstretch/jquery.backstretch.min.js') !!}
        {!! Html::script('assets/global/scripts/app.min.js') !!}
        {!! Html::script('assets/pages/scripts/login-4.min.js') !!}
    </body>

</html>