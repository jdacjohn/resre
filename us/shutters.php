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
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Shutters</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/shutters.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body style="background-color: var(--blue);">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner">
                <div class="characteristics-wrapper container half_padding_left half_padding_right">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="shuttersForm" action="<?php echo HOME_LINK; ?>us/roof-shape.php">
                            <input type="hidden" name="postFrom" value="__usshutters__" />
                            <input type="hidden" name="imgFile" value="" />

                            <div class="row">
                                <div class="chars-border-middle-wt-1"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">3</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Shutters</h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    Hurricane shutters are used to prevent windows from being broken by flying objects during a storm. For a 
                                    shutter to be rated as a hurricane shutter it must meet Miami-Dade TAS 201, 202, and 203, SSTD 12, or
                                    ASTM E 1886 & 1996 standards. Most shutters will have a stamp or be etched identifying it as impact rated.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <div class="chars-border-middle-wt-4"></div>
                                <!-- RADIOS -->
                                <!-- <div class="col-md-2 col-sm-2 hidden-xs chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div> -->
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-10 chars-header-x3 chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-shutters__" value="WS" />
                                        <img id="sht1" src="<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sht1_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        Hurricane Rated
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-shutters__" value="MS" />
                                        <img id="sht2" src="<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sht2_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        Non-Rated
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-shutters__" value="MS" />
                                        <img id="sht3" src="<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sht3_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 white2025Bold">
                                        No Shutters
                                    </div>
                                </div>
                            </div>
                            <div class="row no-padding-bottom no-padding-top">
                                <div class="chars-border-middle-wt-5"></div>
                            </div>

                        </form>
                    </div> <!-- wt-content-wrapper -->
                </div> <!-- ./ characteristics wrapper -->
            </div> <!-- ./ characteristics-inner -->
        </div> <!-- ./ characteristics Container
        
        <!-- Continue Cancel -->
        <div class="bottom-nav">
            <?php 
                $back = 'wall-types';
                $continue = 'roof-shape';
                require($root . 'includes/ccSave.php'); 
            ?>
        </div>   <!-- / .containter -->

        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>

        <!-- Image swap functions for selections -->
        <script>
            $('img').on({
                'click': function() {
                    var hurricaneImageSrc;
                    var nonRatedImageSrc;
                    var noShuttersImageSrc;
                    if ($(this).attr('id') === 'sht1') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sht2');
                        var otherElement2 = document.getElementById('sht3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png') {
                            hurricaneImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-on.png';
                            $(document.getElementById('sht1_cb')).show();
                            nonRatedImageSrc = '<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png';
                            noShuttersImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png';
                            $(this).attr('src',hurricaneImageSrc);
                            $(otherElement1).attr('src',nonRatedImageSrc);
                            $(otherElement2).attr('src',noShuttersImageSrc);
                            $(document.getElementById('sht2_cb')).hide();
                            $(document.getElementById('sht3_cb')).hide();
                        } else {
                            hurricaneImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png';
                            $(this).attr('src', hurricaneImageSrc);
                            $(document.getElementById('sht1_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sht2') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sht1');
                        var otherElement2 = document.getElementById('sht3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png') {
                            nonRatedImageSrc = '<?php echo SITE_ROOT; ?>/us/images/non-rated-on.png';
                            hurricaneImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png';
                            noShuttersImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png';
                            $(this).attr('src',nonRatedImageSrc);
                            $(document.getElementById('sht2_cb')).show();
                            $(otherElement1).attr('src', hurricaneImageSrc);
                            $(document.getElementById('sht1_cb')).hide();
                            $(otherElement2).attr('src', noShuttersImageSrc);
                            $(document.getElementById('sht3_cb')).hide();
                        } else {
                            nonRatedImageSrc = '<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png';
                            $(this).attr('src', nonRatedImageSrc);
                            $(document.getElementById('sht2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sht3') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sht1');
                        var otherElement2 = document.getElementById('sht2');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png') {
                            noShuttersImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-shutters-on.png';
                            hurricaneImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png';
                            nonRatedImageSrc = '<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png';
                            $(this).attr('src',noShuttersImageSrc);
                            $(document.getElementById('sht3_cb')).show();
                            $(otherElement1).attr('src', hurricaneImageSrc);
                            $(document.getElementById('sht1_cb')).hide();
                            $(otherElement2).attr('src', nonRatedImageSrc);
                            $(document.getElementById('sht2_cb')).hide();
                        } else {
                            noShuttersImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png';
                            $(this).attr('src', noShuttersImageSrc);
                            $(document.getElementById('sht3_cb')).hide();
                        }                    
                    }
                }
            });
        </script>

    </body>
</html>