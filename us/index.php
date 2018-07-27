<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');
    
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session on Start');
    $postFrom = getParam('postFrom');
    
    // Check if we're trying to either login or sign up a new account.
    if ($postFrom == '__login__') {
        $loginErrMsg = procLoginRequest();
        $loginTrigger = (!$loginErrMsg == '') ? 'Yes' : 'No';
        $wbTrigger = ($loginTrigger == 'Yes') ? 'No' : 'Yes';
        $wbHeader = (isset($_SESSION[SESSION_NAME]['home'])) ? 'Welcome back.' : 'Welcome.';
        $wbContent = (isset($_SESSION[SESSION_NAME]['home'])) ? 'All of your previous selections have been pre-loaded into our system for you.  Feel free to change any of your home characteristics and generate a new report, or review your old report.' : 'Get started on your customized Resilient Residence Home Storm Damage Assessment Report by entering some simple information about your home and then click continue to answer a few brief questions.<br />&nbsp;<br />You can save your work anytime and come back later to change your answers or view and print your report again.';
    } elseif ($postFrom == '__signup__') {
        $signupErrMsg = procSignupRequest();
        $signupTrigger = (!$signupErrMsg == '') ? 'Yes' : 'No';
        $wbTrigger = ($signupTrigger == 'Yes') ? 'No' : 'Yes';
        $wbHeader = 'Welcome.';
        $wbContent = 'Get started on your customized Resilient Residence Home Storm Damage Assessment Report by entering some simple information about your home and then click continue to answer a few brief questions.<br />&nbsp;<br />You can save your work anytime and come back later to change your answers or view and print your report again.';
    } elseif ($postFrom == '__logout__') {
        procLogoutRequest();
        $logoutTrigger = 'Yes';
    } elseif ($postFrom == 'pwr') {
        $pwResetTrigger = 'Yes';
    } elseif ($postFrom == '__pwreset__') {
        procPWResetRequest();
    } elseif ($postFrom == 'reset') {
        $userId = verifyValidLink();
        printVarIfDebug($userId, getenv('gDebug'), 'User ID from verifyValidLink()');
        if ($userId == 0) {
            $invalidLinkTrigger = 'Yes';
        } else {
            $resetTrigger = 'Yes';
        }
    } elseif ($postFrom == 'login') {
        $loginTrigger = 'Yes';
    } elseif ($postFrom == '__reset__') {
        $result = procUpdatePassword();
        printVarIfDebug($result, getenv('gDebug'), 'Update action result');
        if ($result > 0) {
            $loginTrigger = 'Yes';
            $loginErrMsg = 'Your password has been updated.';
        }
    }
        
    
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
        $homeName = $home->homeName;
        $firstName = $home->homeOwnerFirstName;
        $homeValue = $home->homeValue;
    } else {
        $homeName = '';
        $firstName = '';
        $homeValue = '';
    }

    if (!is_logged_in()) {
        $buttonClass = 'mid-button-mustard disabled';
        $noTab = 'tabIndex="-1"';
    } else {
        $buttonClass = 'mid-button-mustard';
        $noTab = '';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Load site meta information -->
        <?php include($root . 'includes/page-head-meta.php'); ?>
        <title><?php echo PROJECT_TITLE_SHORT; ?> Us Home Damage Assessment</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/us-home.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body class="slate">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="carousel container-fluid">
            <div id="carousel" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo $root; ?>us/images/us-home-bg.png" class="carousel_img resre-img" alt="#" />
                        <div class="carousel-caption container half_padding_left half_padding_right">
                            <div class="carousel-content-wrapper left">
                                <div class="col-12 home-title">
                                    <h1>Resilient Residence</h1>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 chars-header-text">
                                        Wondering whether your home is as wind resistant as it could be?
                                </div>
                                <div class="col-xs-12 slate2532 learn-more">
                                        <a href="#" class="mid-button-sand"><span class="blue2025Bold">Learn more</span></a>
                                </div>
                            </div><!-- /carousel_content_wrapper -->
                        </div><!-- /carousel-caption -->
                    </div><!-- /item -->
                </div><!-- /carousel-inner -->
            </div><!-- /carousel -->      
        </div><!-- /carousel container -->
        <div class="container">
            <div class="row mid-content">
                <div class=" col-xs-12 col-sm-7 chars-header-text slate2025 nine-qs">
                        Answer nine questions to determine your home's wind-resistant features and see how your home will weather a storm.<br />&nbsp;<br />
                        To get started, either login with your existing account, or create a new account.
                </div>
                <div class=' col-xs-6 col-sm-3 mid-button'>
                    <a href="#" class='mid-button-mustard' data-toggle="modal" data-target="#signupModal" id="signupLink"><span class="blue2228Bold">New User</span></a>
                </div>
                <div class=' col-xs-6 col-sm-2 mid-button mid-button-right login-home'>
                    <a href="#" class='mid-button-sand' data-toggle="modal" data-target="#loginModal" id="loginLink"><span class="blue2228Bold">Login</span></a>
                </div>
            </div>
            <div class="row questionairre">
                    <div class="chars-border-middle-wt-1"></div>                                
                    <div class="chars-border-middle-wt-2"></div>                                
                    <div class="lineStopTop"></div>
                <div class="col-xs-12 col-md-12 get-started slate2025">
                        Let's get some information about your home.  We will use the estimated value of your home to provide damage 
                        and replacement estimates.
                </div>
                <form method="post" name="baseConfigForm" id="baseConfigForm" action="<?php echo HOME_LINK; ?>us/loc.php">
                    <input type="hidden" name="postFrom" value="__us-home__" />
                    <div class="col-xs-2 chars-marker chars"><label class="white2532Bold marker-blue" for="input_homeName">A</label></div>
                    <div class="col-xs-10 col-lg-9">
                        <input type="text" class="slate2532 form-blue" name="input_homeName" value="<?php echo ($homeName == 'No-Home-Name') ? '' : $homeName; ?>" placeholder="Name of home" />
                    </div>
                    <div class="clear"></div>
                    <div class="col-xs-2 chars-marker chars"><label class="white2532Bold marker-mustard" for="input_firstName">B</label></div>
                    <div class="col-xs-9 name-field-label slate1640Bold">
                        Enter first name
                    </div>
                    <div class="col-xs-10 col-lg-9">
                        <input type="text" class="slate2532 form-mustard" name="input_firstName" value="<?php echo ($firstName == 'Jane-Doe') ? '' : $firstName; ?>" placeholder="Bob" />
                    </div>
                    <div class="clear"></div>
                    <div class="col-xs-2 chars-marker chars"><label class="white2532Bold marker-blue" for="input_homeValue">C</label></div>
                    <div class="col-xs-10 col-lg-9">
                        <input type="text" class="slate2532 form-blue" name="input_homeValue" value="<?php echo ($homeValue == 1) ? '' : $homeValue; ?>" placeholder="Estimated home value ($)" />
                    </div>
                </form>
            </div>
        </div>

        <div class="container">
            <div class="row cc paleGreen" style="z-index: 100;">
                <div class='col-xs-12 ccrow'>                    
                    <a href="#" class="<?php echo $buttonClass; ?>" onclick="document.getElementById('baseConfigForm').submit();" <?php echo $noTab; ?>><span class="blue2228Bold">Continue</span></a>
                </div>
            </div>
        </div>   <!-- / .containter -->
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- modals -->
        <?php 
            require($root . 'includes/modals/login.php');
            require($root . 'includes/modals/signup.php');
            require($root . 'includes/modals/logout.php');
            require($root . 'includes/modals/welcomeBack.php');
            require($root . 'includes/modals/pwResetRequest.php');
            require($root . 'includes/modals/invalidLink.php');
            require($root .'includes/modals/resetPW.php');
        ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>
        
        <script>
            $(window ).on({
                'load': function() {
                    var loginTrigger = $(document.getElementById('login-trigger')).val();
                    console.log("Trigger Login = " + loginTrigger);
                    if (loginTrigger === 'Yes') {
                        $("#loginModal").modal('toggle');
                    }
                    var signupTrigger = $(document.getElementById('signup-trigger')).val();
                    console.log("Trigger Signup = " + signupTrigger);
                    if (signupTrigger === 'Yes') {
                        $("#signupModal").modal('toggle');
                    }
                    var logoutTrigger = $(document.getElementById('logout-trigger')).val();
                    console.log("Trigger Logout = " + logoutTrigger);
                    if (logoutTrigger === 'Yes') {
                        $("#logoutModal").modal('toggle');
                    }
                    var wbTrigger = $(document.getElementById('wb-trigger')).val();
                    console.log("Trigger Welcome Back = " + logoutTrigger);
                    if (wbTrigger === 'Yes') {
                        $("#wbModal").modal('toggle');
                    }
                    var pwTrigger = $(document.getElementById('pwreset-trigger')).val();
                    console.log("Trigger Password Reset = " + pwTrigger);
                    if (pwTrigger === 'Yes') {
                        $("#pwResetModal").modal('toggle');
                    }
                    var invalidLinkTrigger = $(document.getElementById('invalid-link-trigger')).val();
                    console.log("Trigger Password Link Msg = " + invalidLinkTrigger);
                    if (invalidLinkTrigger === 'Yes') {
                        $("#invalidLinkModal").modal('toggle');
                    }
                    var resetTrigger = $(document.getElementById('reset-trigger')).val();
                    console.log("Trigger Password Reset = " + resetTrigger);
                    if (resetTrigger === 'Yes') {
                        $("#resetModal").modal('toggle');
                    }
                }
            });
        
        </script>
    </body>
</html>
