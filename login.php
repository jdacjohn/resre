<?php
$root = './';
require($root . '_includes/app_start.inc.php');
printVarIfDebug($_SESSION, getenv('gDebug'), 'Session on Start');
$postBack = getParam('postback');
printVarIfDebug($postBack, getenv('gDebug'), 'Post-Back Value');
$errArray = array();
if (getParam('confirm') == 'logout' && (is_logged_in())) {
        //if($gDebug) { printvar($_SESSION[SESSION_NAME], 'Session before logout block'); }
        reset_session();
        //if($gDebug) { printvar($_SESSION[SESSION_NAME], 'Session after logout block'); }
} elseif (isset($_POST['formSubmit'])) {
    printVarIfDebug($_POST['postBackURL'], getenv('gDebug'), 'PostBack URL from Form');
    // Validate some fields
    $email = filter_input(INPUT_POST,'input_email',FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $errArray['badEmail'] = 'Please enter a valid email address';
    }
    $pw1 = escape(trim($_POST['input_password']));
    if (count($errArray) == 0) {
        // All the input is good, let's create a new user in the database, start a session and redirect user back to where they came from
        $loggedIn = user_login($email, $pw1);
        if ($loggedIn > 0) {
            // Set up a temp hash and send an email verification link. (Maybe)
            // Initialize a session with the user
            echo "Writing session and redirecting<br />";
            init_user_session($email);
            header('location: ' . $postBack);
        } else {
            $errArray['badLogin'] = 'There was a problem with either the email address or the password you entered.';
        }
    }
}
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <!-- Load site meta information -->
            <?php include($root . 'includes/page-head-meta.php'); ?>
            <title><?php echo PROJECT_TITLE_SHORT; ?> Login</title>
            <!-- Load site CSS -->
            <?php include($root . 'includes/page-styles.php'); ?>
            <!-- Load Page HEAD script files -->
            <?php include($root . 'includes/page-head-scripts.php'); ?>
        </head>
        <body style="background-color: var(--blue);">
            <header>
                <?php include($root . 'includes/nav-menu.php'); ?>
            </header>
            <div class="container">
                <div class="col-md-10 col-md-offset-1 login">
                    <div style="width: 50%; float: left">
                        <h2>Login.</h2>
                    </div>
                    <div style="width: 50%; float: left; text-align: right; padding-top: 34px">
                        <a href="<?php echo HOME_LINK; ?>signup.php?postback=<?php echo $postBack; ?>" class="mid-button-sand"><span class="blue2228Bold">Sign up</span></a>
                    </div>
                    <div class="clear"></div>
                    <div class='col-md-12 fix-left'>
                        <p class="slate2230">
                            Don't have an account? <a href="<?php echo HOME_LINK; ?>signup.php?postback=<?php echo $postBack; ?>">Sign up today</a>.
                        </p>
                    </div>
                    <form action='#' method="post" name="login_form">
                        <input type="hidden" name="postBackURL" value="<?php echo $postBack; ?>" />
                        <input type="hidden" name="formSubmit" value="__login__" />
                        <div class="col-md-12 fix-left"><label class="slate1640Bold" style="margin-bottom: 0px; " for="input_email">Email</label></div>
                        <div class="col-md-12 fix-left fix-top">
                            <input type="email" required class="slate2025 form-mustard" name="input_email" value="<?php echo isset($_POST['input_email']) ? $_POST['input_email'] : ''; ?>" placeholder="you@yourdomain.com" />
                        </div>
                        <div class="col-md-12 fix-left" style="margin-top: 40px;">
                            <input type="password" required class="slate2025 form-blue" name="input_password" value="<?php echo isset($_POST['input_password']) ? $_POST['input_password'] : ''; ?>" placeholder="PASSWORD" />
                        </div>
                        <div class="col-md-12 fix-left" style="margin-top: 40px;">
                            <div style="width: 50%; float: left">
                                <a href="#" class="mid-button-mustard" onclick="document.login_form.submit();"><span class="blue2228Bold">Submit</span></a>
                                <a href="#" class="mid-button-sand" onclick="document.login_form.reset();"><span class="blue2228Bold">Cancel</span></a>
                            </div>
                            <div style="width: 50%; float: left; text-align: right; padding-top: 34px">
                                <p class="slate2025"><a href="<?php echo HOME_LINK; ?>resetpw.php">Lost Password</a></p>
                            </div>
                            <div class="clear"></div>                            
                        </div>
                        <?php
                            if (count($errArray) > 0) {
                        ?>
                        <div class="col-md-12 fix-left" style="margin-top: 40px">
                            <?php foreach($errArray as $error) { ?>
                            <p><span style="color: #ff0000; font-weight: bold"><?php echo $error; ?></span></p>
                            <?php } ?>
                        </div>
                            <?php } ?>
                        
                    </form>
                </div>
            </div>
        </body>
    </html>
