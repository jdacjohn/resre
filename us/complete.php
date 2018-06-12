<?php
$root = '../';
require($root . '_includes/app_start.inc.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Load site meta information -->
        <?php include($root . 'includes/page-head-meta.php'); ?>
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Wall Types</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/complete.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body>
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="carousel container-fluid">
            <div id="carousel" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo $root; ?>us/images/us-complete-bg.png" class="carousel_img" alt="#" />
                        <div class="carousel-caption container half_padding_left half_padding_right">
                            <div class="carousel-content-wrapper left">
        <div class="row">
            <div class="complete-border-middle-1"></div>                                
            <div class="complete-border-middle-2"></div>                                
            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker complete-modal"><span class="blue2532Bold marker-complete" style="margin-bottom: 0px; ">100</span></div>
            <!-- <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Your Report is Complete</h4></div> -->
        </div>
                            </div>
                        </div><!-- /carousel_content_wrapper -->
                    </div><!-- /item -->
                </div><!-- /carousel-inner -->
            </div><!-- /carousel -->      
        </div><!-- /carousel container -->

        <div class="row">
            <div class="chars-border-middle-wt-1"></div>                                
            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                <span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">
                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                </span>
            </div>
            <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Your Report is Complete</h4></div>
        </div>
        <div class="row">
            <div class="chars-border-middle-wt-2 hidden-xs"></div>
            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
            <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                Click Continue to view your report, or Back to change your selections.
            </div>
        </div>

        <!-- Continue-Cancel-Save -->
        <div class="row complete">
            <div class="chars-border-middle"></div>                                
            <div class='col-xs-10 col-xs-offset-1 col-sm-6 col-md-6 ccButtons ccButton-first'>
                <a href="<?php echo HOME_LINK; ?>us/report.php" class='mid-button-mustard'><span class="blue2228Bold">Continue</span></a>
            </div>
            <div class='col-xs-5 col-xs-offset-1 col-sm-2 col-md-2 ccButtons ccButton-middle'>
                <a href="<?php echo HOME_LINK; ?>us/water-barrier.php" class='mid-button-sand'><span class="blue2228Bold">Back</span></a>
            </div>
            <div class='col-xs-5 col-sm-2 col-md-2 ccButtons ccButton-last'>
                <a href="#" class='mid-button-sand'><span class="blue2228Bold">Save</span></a>
            </div>
        </div>
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>
    </body>
</html>
