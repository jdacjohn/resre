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
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Garage Door</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/garage.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    </head>
    <body style="background-color: var(--blue);">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner">
                <div class="characteristics-wrapper container half_padding_left half_padding_right">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="garageForm" action="<?php echo HOME_LINK; ?>us/roof-wall.php">
                            <input type="hidden" name="postFrom" value="__usgaragedoor__" />
                            <input type="hidden" name="imgFile" value="" />

                            <div class="row">
                                <div class="chars-border-middle-wt-1"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">5</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Garage Door</h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    The best method to determine your garage door type is to look for a proof of compliance sticker (typically 
                                    yellow or white).  It will identify the type of door.  If your door does not have a label on it you may be able to 
                                    identify from the number of bracings.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <div class="chars-border-middle-wt-4"></div>
                                <div class="chars-border-middle-wt-4a"></div>
                                <!-- RADIOS -->
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-gdoor__" value="impact" />
                                        <img id="gdr1" src="<?php echo SITE_ROOT; ?>/us/images/garage-impact-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="gdr1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Impact
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-gdoor__" value="wind" />
                                        <img id="gdr2" src="<?php echo SITE_ROOT; ?>/us/images/garage-wind-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="gdr2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Wind
                                    </div>
                                </div>
                                <div class="clear hidden-xs"></div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-gdoor__" value="standard" />
                                        <img id="gdr3" src="<?php echo SITE_ROOT; ?>/us/images/garage-standard-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="gdr3_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Standard
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-gdoor__" value="unknown" />
                                        <img id="gdr4" src="<?php echo SITE_ROOT; ?>/us/images/unknown-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="gdr4_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label white2025Bold">
                                        Unknown
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
                $back = 'roof-shape';
                $continue = 'roof-wall';
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
                    var impactImageSrc;
                    var windImageSrc;
                    var standardImageSrc;
                    var unknownImageSrc;
                    if ($(this).attr('id') === 'gdr1') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('gdr2');
                        var otherElement2 = document.getElementById('gdr3');
                        var otherElement3 = document.getElementById('gdr4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/garage-impact-off.png') {
                            impactImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-impact-on.png';
                            $(document.getElementById('gdr1_cb')).show();
                            windImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-wind-off.png';
                            standardImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-standard-off.png';
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',impactImageSrc);
                            $(otherElement1).attr('src',windImageSrc);
                            $(otherElement2).attr('src',standardImageSrc);
                            $(otherElement3).attr('src',unknownImageSrc);
                            $(document.getElementById('gdr2_cb')).hide();
                            $(document.getElementById('gdr3_cb')).hide();
                            $(document.getElementById('gdr4_cb')).hide();
                        } else {
                            impactImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-impact-off.png';
                            $(this).attr('src', impactImageSrc);
                            $(document.getElementById('gdr1_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'gdr2') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('gdr1');
                        var otherElement2 = document.getElementById('gdr3');
                        var otherElement3 = document.getElementById('gdr4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/garage-wind-off.png') {
                            windImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-wind-on.png';
                            impactImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-impact-off.png';
                            standardImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-standard-off.png';
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',windImageSrc);
                            $(document.getElementById('gdr2_cb')).show();
                            $(otherElement1).attr('src', impactImageSrc);
                            $(document.getElementById('gdr1_cb')).hide();
                            $(otherElement2).attr('src', standardImageSrc);
                            $(document.getElementById('gdr3_cb')).hide();
                            $(otherElement3).attr('src', unknownImageSrc);
                            $(document.getElementById('gdr4_cb')).hide();
                        } else {
                            windImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-wind-off.png';
                            $(this).attr('src', windImageSrc);
                            $(document.getElementById('gdr2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'gdr3') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('gdr1');
                        var otherElement2 = document.getElementById('gdr2');
                        var otherElement3 = document.getElementById('gdr4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/garage-standard-off.png') {
                            standardImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-standard-on.png';
                            impactImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-impact-off.png';
                            windImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-wind-off.png';
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',standardImageSrc);
                            $(document.getElementById('gdr3_cb')).show();
                            $(otherElement1).attr('src', impactImageSrc);
                            $(document.getElementById('gdr1_cb')).hide();
                            $(otherElement2).attr('src', windImageSrc);
                            $(document.getElementById('gdr2_cb')).hide();
                            $(otherElement3).attr('src', unknownImageSrc);
                            $(document.getElementById('gdr4_cb')).hide();
                        } else {
                            standardImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-standard-off.png';
                            $(this).attr('src', standardImageSrc);
                            $(document.getElementById('gdr3_cb')).hide();
                        }                    
                    } else if ($(this).attr('id') === 'gdr4') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('gdr1');
                        var otherElement2 = document.getElementById('gdr2');
                        var otherElement3 = document.getElementById('gdr3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png') {
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-on.png';
                            standardImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-standard-off.png';
                            impactImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-impact-off.png';
                            windImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-wind-off.png';
                            $(this).attr('src',unknownImageSrc);
                            $(document.getElementById('gdr4_cb')).show();
                            $(otherElement1).attr('src', impactImageSrc);
                            $(document.getElementById('gdr1_cb')).hide();
                            $(otherElement2).attr('src', windImageSrc);
                            $(document.getElementById('gdr2_cb')).hide();
                            $(otherElement3).attr('src', standardImageSrc);
                            $(document.getElementById('gdr3_cb')).hide();
                        } else {
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src', unknownImageSrc);
                            $(document.getElementById('gdr4_cb')).hide();
                        }                    
                    }
                }
            });
        </script>

    </body>
</html>
