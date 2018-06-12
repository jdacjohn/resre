<?php
$root = './';
require($root . '_includes/app_start.inc.php');
//printVarIfDebug($_SESSION, getenv('gDebug'), 'Session on Start');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Load site meta information -->
        <?php include($root . 'includes/page-head-meta.php'); ?>
        <title><?php echo PROJECT_TITLE_SHORT; ?> Page Layout Test</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
    </head>
    <body>
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="carousel container-fluid">
            <div id="carousel" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo $root; ?>images/us-home-bg.png" class="carousel_img" alt="#" />
                        <div class="carousel-caption container half_padding_left half_padding_right">
                            <div class="carousel-content-wrapper left">
                                <h1>Resilient Residence</h1>
                                <p class="slate2532">
                                   Wondering whether your home is as wind resistant as it could be?
                                </p> 
                                <p class="slate2532">
                                   <a href="#" class="mid-button-sand"><span class="blue2025Bold">Learn more</span></a>
                                </p> 
                            </div><!-- /carousel_content_wrapper -->
                        </div><!-- /carousel-caption -->
                    </div><!-- /item -->
                </div><!-- /carousel-inner -->
            </div><!-- /carousel -->      
        </div><!-- /carousel container -->
        <div class="container-fluid">
            <div class="col-12 mid-content">
                <div class="col-md-6">
                    <p class="slate2025">
                        Answer nine questions to determine your home's wind-resistant features and see how your home will weather a storm.
                    </p>                   
                </div>
                <div class='col-md-4'>
                    <a href="#" class='mid-button-mustard'><span class="blue2228Bold">Get Started</span></a>
                </div>
                <div class='col-md-2'>
                    <a href="<?php echo HOME_LINK; ?>login.php?postback=<?php echo $gQualifiedSelfRequest; ?>" class='mid-button-sand'><span class="blue2228Bold">Login</span></a>
                </div>
            </div>
        </div> <!-- / .container-fluid -->
        <div class="container-fluid">
        <div class="col-12 questionairre">
            <p class="slate2532">
                Let's get some information about your home.  We will use the estimated value of your home to provide damage 
                and replacement estimates.
            </p>
        </div>
        <form method="post" name="baseConfigForm" action="<?php echo HOME_LINK; ?>us/loc.php">
            <input type="hidden" name="postFrom" value="__ushome__" />
            <div class="col-12 questionairre qinput-group">
                <div class="col-md-2 fix-left"><label class="white2532Bold marker-blue" style="margin-bottom: 0px; " for="input_homeName">A</label></div>
                <div class="col-md-8 fix-left fix-top" style="top: 5px;">
                    <input type="text" class="slate2532 form-blue" name="input_homeName" value="<?php echo isset($_POST['input_homeName']) ? $_POST['input_homeName'] : ''; ?>" placeholder="Name of home" />
                </div>
            </div>
            <div class="col-12 questionairre qinput-group">
                <div class="col-md-2 fix-left"><label class="white2532Bold marker-mustard" style="margin-bottom: 0px; " for="input_firstName">B</label></div>
                <div class="col-md-8 fix-left" style="top: -20px">
                    <span class="slate1640Bold">Enter first name</span><br />
                    <input type="text" class="slate2532 form-mustard" name="input_firstName" value="<?php echo isset($_POST['input_firstName']) ? $_POST['input_firstName'] : ''; ?>" placeholder="Bob" />
                </div>
            </div>
            <div class="col-12 questionairre qinput-group">
                <div class="col-md-2 fix-left"><label class="white2532Bold marker-blue" style="margin-bottom: 0px; " for="input_homeValue">C</label></div>
                <div class="col-md-8 fix-left fix-top" style="top: 5px;">
                    <input type="number" step="1" class="slate2532 form-blue" name="input_homeValue" value="<?php echo isset($_POST['input_homeValue']) ? $_POST['input_homeValue'] : ''; ?>" placeholder="Estimated value of your home (in dollars)" />
                </div>
            </div>
        </form>
        </div> <!-- / .container-fluid -->
        <div class="container-fluid">
            <div class="col-12 continue">
                <div class='col-md-6 fix-left'>
                    <a href="<?php echo $root; ?>us/loc.php" class='mid-button-mustard'><span class="blue2228Bold">Continue</span></a>
                </div>
                <div class='col-md-6 right' style='text-align: right;'>
                    <a href="<?php echo HOME_LINK; ?>" class='mid-button-sand'><span class="blue2228Bold">Cancel</span></a>
                </div>
            </div>   
        </div> <!-- / .container-fluid -->
        <!-- Footer -->
        <?php include($root . 'includes/page-footer.php'); ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>
    </body>
</html>
