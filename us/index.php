<?php
$root = '../';
require($root . '_includes/app_start.inc.php');
//printVarIfDebug($_SESSION, getenv('gDebug'), 'Session on Start');
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
    </head>
    <body>
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="carousel container-fluid">
            <div id="carousel" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo $root; ?>us/images/us-home-bg.png" class="carousel_img" alt="#" />
                        <div class="carousel-caption container half_padding_left half_padding_right">
                            <div class="carousel-content-wrapper left">
                                <div class="col-12">
                                <h1>Resilient Residence</h1>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 fix-left">
                                <p class="slate2532">
                                   Wondering whether your home is as wind resistant as it could be?
                                </p> 
                                <p class="slate2532">
                                   <a href="#" class="mid-button-sand"><span class="blue2025Bold">Learn more</span></a>
                                </p> 
                                </div>
                            </div><!-- /carousel_content_wrapper -->
                        </div><!-- /carousel-caption -->
                    </div><!-- /item -->
                </div><!-- /carousel-inner -->
            </div><!-- /carousel -->      
        </div><!-- /carousel container -->
        <div class="container">
            <div class="row mid-content">
                <div class="col-md-6 fix-left">
                    <p class="slate2025">
                        Answer nine questions to determine your home's wind-resistant features and see how your home will weather a storm.
                    </p>                   
                </div>
                <div class='col-md-3 col-xs-7 mid-button'>
                    <a href="#" class='mid-button-mustard'><span class="blue2228Bold">Get Started</span></a>
                </div>
                <div class='col-md-3 col-xs-4 mid-button'>
                    <a href="<?php echo HOME_LINK; ?>login.php?postback=<?php echo $gQualifiedSelfRequest; ?>" class='mid-button-sand'><span class="blue2228Bold">Login</span></a>
                </div>
            </div>
        </div> <!-- / .container -->
        <div class="container fix-bottom">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2 questionairre padding-bottom-min">
                    <p class="slate2025">
                        Let's get some information about your home.  We will use the estimated value of your home to provide damage 
                        and replacement estimates.
                    </p>
                </div>
            </div>
        <form method="post" name="baseConfigForm" action="<?php echo HOME_LINK; ?>us/loc.php">
            <input type="hidden" name="postFrom" value="__ushome__" />
            <div class="row">
                <div class="col-12 questionairre no-padding-top no-padding-bottom">
                    <div class="border-bottom"></div>
                </div>
            </div>
            <div class="row fix-bottom questionairre qinput-group no-padding-bottom no-padding-top">
                <div class="border-middle"></div>
                <div class="col-md-2 col-xs-2 fix-left centerline"><label class="white2532Bold marker-blue" style="margin-bottom: 0px; " for="input_homeName">A</label></div>
                <div class="col-md-10 col-xs-8 qinput-field">
                    <input type="text" class="slate2532 form-blue" name="input_homeName" value="<?php echo isset($_POST['input_homeName']) ? $_POST['input_homeName'] : ''; ?>" placeholder="Name of home" />
                </div>
            </div>
            <div class="row fix-bottom questionairre qinput-group no-padding-bottom no-padding-top">
                <div class="border-middle"></div>
                <div class="col-2 col-xs-2 fix-left centerline"><label class="white2532Bold marker-mustard" style="margin-bottom: 0px; " for="input_firstName">B</label></div>
                <div class="col-md-10 col-xs-8 qinput-field" style="top: -20px">
                    <span class="slate1640Bold" >Enter first name</span>
                    <div class="clear"></div>
                    <input type="text" class="slate2532 form-mustard" name="input_firstName" value="<?php echo isset($_POST['input_firstName']) ? $_POST['input_firstName'] : ''; ?>" placeholder="Bob" />
                </div>
            </div>
            <div class="row fix-bottom questionairre qinput-group no-padding-bottom no-padding-top">
                <div class="border-middle"></div>
                <div class="col-2 col-xs-2 fix-left centerline"><label class="white2532Bold marker-blue" style="margin-bottom: 0px; " for="input_homeValue">C</label></div>
                <div class="col-md-10 col-xs-8  fix-top qinput-field">
                    <input type="number" step="1" class="slate2532 form-blue" name="input_homeValue" value="<?php echo isset($_POST['input_homeValue']) ? $_POST['input_homeValue'] : ''; ?>" placeholder="Estimated home value (in dollars)" />
                </div>
           </div>
            <!-- <div class="row fix-bottom">
                <div class="col-12 questionairre qinput-group no-padding-top no-padding-bottom">
                    <div class="border-middle"></div>
                    <div class="col-2">&nbsp;</div>
                </div>
        </div> -->
        </form>
        </div> <!-- / .container--->
        <div class="container" style="height: 125px;">
            <div class="row questionairre qinput-group no-padding-bottom no-padding-top paleGreen">
                    <div class="border-middle"></div>
                    <div class="border-middle-hide"></div>
                    <div class='col-5 col-xs-6 col-offset-1 centerline'>                    
                        <a href="<?php echo $root; ?>us/loc.php" class='mid-button-mustard'><span class="blue2228Bold">Continue</span></a>
                    </div>
                    <div class='col-5 col-xs-4 right centerline' style='text-align: center;'>
                        <a href="<?php echo HOME_LINK; ?>" class='mid-button-sand'><span class="blue2228Bold">Cancel</span></a>
                    </div>
            </div>
        </div>   <!-- / .containter -->
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>
    </body>
</html>
