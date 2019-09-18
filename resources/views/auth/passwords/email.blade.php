<!DOCTYPE html>
<html lang="en">
    <head>
        <head>
<base href="{{URL::asset('/')}}" target="_top"> 
  <link rel="stylesheet" href="{{{ URL::asset('assets/css/bootstrap.min.css')}}}" />
  <link rel="stylesheet" href="{{{ URL::asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}}" />
  <link rel="stylesheet" href="{{{ URL::asset('assets/css/fonts.googleapis.com.css')}}}" />
  <link rel="stylesheet" href="{{{ URL::asset('assets/css/ace.min.css')}}}" />
  
  <script src="{{{ URL::asset('assets/js/bootstrap.min.js')}}}"></script>

       
    </head>

    <body class="login-layout light-login">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                <h1>
                                    <!-- <i class="ace-icon fa fa-leaf green"></i> -->
                                    <span class="red">VTS</span>
                                    <span class="white" id="id-text2">Application</span>
                                </h1>
                                <h3 class="blue" id="id-company-text">&copy; TalentBurst</h3>
                            </div>

                            <div class="space-6"></div>

                            

                                <div id="forgot-box" class="forgot-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header red lighter bigger">
                                                <i class="ace-icon fa fa-key"></i>
                                                Reset Password
                                            </h4>

                                            <div class="space-6"></div>

                                            @if(Session::has('success'))
                                               <div class="alert alert-success">
                                                 {{ Session::get('success') }}
                                               </div>
                                            @endif

                                            <p>
                                                Enter your email and to receive instructions
                                            </p>

                                            {!! Form::open(['route'=>'password.email', 'class' => 'form']) !!}
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email']) !!}
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    </label>

                                                    <div class="clearfix">
                                                        <button type="submit" class="btn btn-danger">
                                                             <i class="ace-icon fa fa-key"></i>
                                                            {{ __('Send Password Reset Link') }}
                                                        </button>
                                                       
                                                    </div>
                                                </fieldset>
                                            {!! Form::close() !!}
                                        </div><!-- /.widget-main -->

                                        <div class="toolbar center">
                                            <a href="{{ url('/login') }}" class="back-to-login-link">
                                                Back to login
                                                <i class="ace-icon fa fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.forgot-box -->
                                
                            </div><!-- /.position-relative -->

                            <!-- <div class="navbar-fixed-top align-right">
                                <br />
                                &nbsp;
                                <a id="btn-login-dark" href="#">Dark</a>
                                &nbsp;
                                <span class="blue">/</span>
                                &nbsp;
                                <a id="btn-login-blur" href="#">Blur</a>
                                &nbsp;
                                <span class="blue">/</span>
                                &nbsp;
                                <a id="btn-login-light" href="#">Light</a>
                                &nbsp; &nbsp; &nbsp;
                            </div> -->

                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
             $(document).on('click', '.toolbar a[data-target]', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                $('.widget-box.visible').removeClass('visible');//hide others
                $(target).addClass('visible');//show target
             });
            });
            
            
            
            //you don't need this, just used for changing background
            jQuery(function($) {
             $('#btn-login-dark').on('click', function(e) {
                $('body').attr('class', 'login-layout');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'blue');
                
                e.preventDefault();
             });
             $('#btn-login-light').on('click', function(e) {
                $('body').attr('class', 'login-layout light-login');
                $('#id-text2').attr('class', 'grey');
                $('#id-company-text').attr('class', 'blue');
                
                e.preventDefault();
             });
             $('#btn-login-blur').on('click', function(e) {
                $('body').attr('class', 'login-layout blur-login');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'light-blue');
                
                e.preventDefault();
             });
             
            });
        </script>
    </body>
</html>

