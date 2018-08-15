<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');

    $mitigants = new resre\ResReMitigators();
    $home = new resre\ResReHome();
    $trigger = isset($_SESSION[SESSION_NAME]['trigger']) ? $_SESSION[SESSION_NAME]['trigger'] : '';
    // Now wipe the trigger so we don't hose subsequent pages
    unset($_SESSION[SESSION_NAME]['trigger']);

    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    }
    // Get the home object from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    }
    $heading = isset($_SESSION[SESSION_NAME]['heading']) ? $_SESSION[SESSION_NAME]['heading'] : 'Your Report is Complete';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Load site meta information -->
<?php include($root . 'includes/page-head-meta.php'); ?>
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Criteria Selection Complete</title>
        <!-- Load Page HEAD script files -->
<?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-sel.css" rel='stylesheet' type='text/css' media="all" />
<!--        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" /> -->
        <link href="<?php echo $root; ?>css/complete.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body>
<?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="complete-modal"><span class="blue2532Bold marker-complete" style="margin-bottom: 0px; ">100</span></div>
        <div class="carousel container">
            <div id="carousel" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo $root; ?>us/images/us-complete-bg.png" class="carousel_img" alt="#" />
                        <div class="carousel-caption container half_padding_left half_padding_right" id="topCarousel">
                            <div class="carousel-content-wrapper left">
                                <div class="row">
                                    <!-- <div class="col-xs-2 complete-modal"><span class="blue2532Bold marker-complete" style="margin-bottom: 0px; ">100</span></div> -->
                                </div>
                            </div>
                        </div><!-- /carousel_content_wrapper -->
                    </div><!-- /item -->
                </div><!-- /carousel-inner -->
            </div><!-- /carousel -->      
        </div><!-- /carousel container -->


        <div class="row" id="markerDown">
            <div class="col-xs-2 chars-marker chars">
                <span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">
                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                </span>
            </div>
            <div class="col-xs-8 topic"><h4 class="chars-h4"><?php echo $heading; ?></h4></div>
        </div>
        <div class="row">
            <div class="col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
            <div class="col-xs-9 col-md-8 chars-desc white2025">
                Click Continue to view your report, or Back to change your selections.
            </div>
        </div>
        <form method="post" name="completeForm" id="completeForm" action="<?php echo HOME_LINK; ?>_includes/procCrit/procUSReport.php">
            <input type="hidden" name="postFrom" id="postFrom" value="__us-complete__" />
            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />
        </form>
        <!-- Continue-Cancel-Save -->
        <div class="row complete" id="ccSave">
            <div class='col-xs-12 col-sm-6 ccButtons ccButton-first'>
                <a class='mid-button-mustard' onclick="document.getElementById('completeForm').submit();"><span class="blue2228Bold">Continue</span></a>
            </div>
            <div class='col-xs-6 col-sm-2 ccButtons ccButton-middle'>
                <a id="moveBack" class='mid-button-sand'><span class="blue2228Bold">Back</span></a>
            </div>
            <div class='col-xs-6 col-sm-2 ccButtons ccButton-last'>
                <a id="stayHere" class='mid-button-sand'><span class="blue2228Bold">Save</span></a>
            </div>
        </div>
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Modal for saving data -->
        <?php 
           $action = SITE_ROOT . '/_includes/procCrit/procUSReport.php';
            include($root . 'includes/modals/dataSave.php'); 
        ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>

        <script>
            $(window ).on({
                'load': function() {
                    var trigger = $(document.getElementById('trigger')).attr('value');
                    console.log("trigger = " + trigger);
                    if (trigger === 'dataSaved') {
                        console.log('Session state saved to DB');
                        $("#dataSavedModal").modal('toggle');
                    }
                }
            });
            $("#moveBack").click(function () {
                 $(document.getElementById('postFrom')).val('__us-complete-back__');
                $("#completeForm").submit();
            });
            $("#stayHere").click(function () {
                 $(document.getElementById('postFrom')).val('__us-complete-save__');
                $("#completeForm").submit();
            });
        </script>

    </body>
</html>
