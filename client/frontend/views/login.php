<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(isset($message)){
    $loginError = "<div class=\"alert alert-danger\" role=\"alert\"><small>" . $message . "</small></div>";
} else {
    $loginError = '';
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login &#124; Activity Report</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">  

    <link rel="stylesheet" href="includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/font-awesome.min.css">
    <link rel="stylesheet" href="includes/css/login.css">

    <script src="includes/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<div class="clearfix top-spacer"></div>

<!-- <div class="col-md-4 col-md-offset-4 col-md-bg-green"> -->
    <h3 class="text-center text-login"><i class="fa fa-leaf"></i> Activity Report</h3>
<!-- </div> -->
<!-- <hr class="clearfix" /> -->
    
<div class="container" id="login-modal">
        <div class="login-content row">
            <div id="div-forms" class="col-md-4 col-md-offset-4">
            
                <!-- Begin # Login Form -->
                <form id="login_form" method="post" action="<?php echo current_url(); ?>">
                    <div class="login-body">
                        <div id="div-login-msg">
                            <!--<div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>-->
                            <span id="text-login-msg">Type your username and password.</small>
                            </span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input name="login_username" class="form-control" type="text" placeholder="Username" />
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input name="login_password" class="form-control" type="password" placeholder="Password" />
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="login-remember">
                            <label for="login-remember"><small>Remember me</small></label>
                        </div>
                    </div>
                    <div class="login-footer">
                        <div>
                            <button type="submit" class="btn btn-info btn-lg btn-block "><i class="fa fa-lock"></i> SIGN IN</button>
                        </div>
                        <div>
                            <button id="login_lost_btn" type="button" class="btn btn-link">Forgot Password?</button>
                            <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                            <a class="btn btn-link" href="uploads/downloadables/Attachments_Re_Clean_Air_Asia_Ne.zip">Android</a>
                        </div>
                    </div>
                </form>
                <!-- End # Login Form -->
                
                <!-- Begin | Lost Password Form -->
                <form id="lost-form" style="display:none;">
                    <div class="login-body">
                        <div id="div-lost-msg">
                            <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-lost-msg" class="text-muted">Type your e-mail.</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input id="lost_email" class="form-control" type="text" placeholder="E-Mail" required />
                        </div>
                    </div>
                    <div class="login-footer">
                        <div>
                            <button type="submit" class="btn btn-info btn-lg btn-block">Send</button>
                        </div>
                        <div>
                            <button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
                            <button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
                        </div>
                    </div>
                </form>
                <!-- End | Lost Password Form -->
                
                <!-- Begin | Register Form -->
                <form id="register-form" style="display:none;">
                    <div class="login-body">
                        <div id="div-register-msg">
                            <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-register-msg" class="text-muted">Register an account.</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input id="register_username" class="form-control" type="text" placeholder="Username"/>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input id="register_email" class="form-control" type="text" placeholder="E-Mail" />
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input id="register_password" class="form-control" type="password" placeholder="Password" />
                        </div>
                    </div>
                    <div class="login-footer">
                        <div>
                            <button type="submit" class="btn btn-info btn-lg btn-block">Register</button>
                        </div>
                        <div>
                            <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                            <button id="register_lost_btn" type="button" class="btn btn-link">Forgot Password?</button>
                        </div>
                    </div>
                </form>
                <!-- End | Register Form -->
                
            </div>
            
        </div>
</div>

<div class="footer row">
    <p class="text-center text-muted"><small>Copyright &copy; 2017. All Rights Reserved. Activity Report v.0.1</small></p>
</div>
    
    

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>');</script>

    <script src="includes/js/vendor/bootstrap.min.js"></script>
    <script>
        (function($){
            // Login Error Message
            var loginError = '<?php echo $loginError ?>',
                loginErrorWrapper = $('#div-login-msg');
                
            loginErrorWrapper.html(loginError);
        })(window.jQuery);
    </script>

    <!-- Plugin JS Files -->
    <script src="includes/js/login.js"></script>
</body>
</html>
