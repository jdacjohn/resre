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
        <link href="<?php echo $root; ?>css/roofWall.css" rel='stylesheet' type='text/css' media="all" />
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
                        <form method="post" name="garageForm" action="<?php echo HOME_LINK; ?>us/roof-deck-attach-A.php">
                            <input type="hidden" name="postFrom" value="__usroofwall__" />
                            <input type="hidden" name="imgFile" value="" />

                            <div class="row">
                                <div class="chars-border-middle-wt-1"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">6</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Roof to Wall Connections</h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    Your home's ability to resist the extreme force of wind is only as strong as it weakest link. To determine your 
                                    type of connections, go into the attic and look along where the framing members meet the wall of your home. 
                                    Sometimes you can see the reflection of the straps or clips with the use of a flashlight.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <div class="chars-border-middle-wt-4"></div>
                                <div class="chars-border-middle-wt-4a"></div>
                                <div class="chars-border-middle-wt-4b"></div>
                                <!-- RADIOS -->
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3 chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="tnail" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/rw-toenail-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        Toe-Nail
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="strap" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/rw-straps-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        Straps
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="clip" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/rw-clips-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        Clips
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3 chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="other" />
                                        <img id="sel4" src="<?php echo SITE_ROOT; ?>/us/images/other-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel4_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 white2025Bold">
                                        Other
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="unknown" />
                                        <img id="sel5" src="<?php echo SITE_ROOT; ?>/us/images/unknown-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel5_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 white2025Bold">
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
                $back = 'garage-door';
                $continue = 'roof-deck-attach-A';
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
                    var sel1Src;
                    var sel2Src;
                    var sel3Src;
                    var sel4Src;
                    var sel5Src;
                    if ($(this).attr('id') === 'sel1') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel2');
                        var otherElement2 = document.getElementById('sel3');
                        var otherElement3 = document.getElementById('sel4');
                        var otherElement4 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/rw-toenail-off.png') {
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rw-toenail-on.png';
                            $(document.getElementById('sel1_cb')).show();
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rw-straps-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rw-clips-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel1Src);
                            $(otherElement1).attr('src',sel2Src);
                            $(otherElement2).attr('src',sel3Src);
                            $(otherElement3).attr('src',sel4Src);
                            $(otherElement4).attr('src',sel5Src);
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rw-toenail-off.png';
                            $(this).attr('src', sel1Src);
                            $(document.getElementById('sel1_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel2') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel3');
                        var otherElement3 = document.getElementById('sel4');
                        var otherElement4 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/rw-straps-off.png') {
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rw-straps-on.png';
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rw-toenail-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rw-clips-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel2Src);
                            $(document.getElementById('sel2_cb')).show();
                            $(otherElement1).attr('src', sel1Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(otherElement2).attr('src', sel3Src);
                            $(document.getElementById('sel3_cb')).hide();
                            $(otherElement3).attr('src', sel4Src);
                            $(document.getElementById('sel4_cb')).hide();
                            $(otherElement4).attr('src', sel5Src);
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rw-straps-off.png';
                            $(this).attr('src', sel2Src);
                            $(document.getElementById('sel2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel3') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel4');
                        var otherElement4 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/rw-clips-off.png') {
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rw-clips-on.png';
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rw-toenail-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rw-straps-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel3Src);
                            $(document.getElementById('sel3_cb')).show();
                            $(otherElement1).attr('src', sel1Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(otherElement2).attr('src', sel2Src);
                            $(document.getElementById('sel2_cb')).hide();
                            $(otherElement3).attr('src', sel4Src);
                            $(document.getElementById('sel4_cb')).hide();
                            $(otherElement4).attr('src', sel5Src);
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rw-clips-off.png';
                            $(this).attr('src', sel3Src);
                            $(document.getElementById('sel3_cb')).hide();
                        }                    
                    } else if ($(this).attr('id') === 'sel4') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/other-off.png') {
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/other-on.png';
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rw-toenail-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rw-straps-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rw-clips-off.png';
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel4Src);
                            $(document.getElementById('sel4_cb')).show();
                            $(otherElement1).attr('src', sel1Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(otherElement2).attr('src', sel2Src);
                            $(document.getElementById('sel2_cb')).hide();
                            $(otherElement3).attr('src', sel3Src);
                            $(document.getElementById('sel3_cb')).hide();
                            $(otherElement4).attr('src', sel5Src);
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            $(this).attr('src', sel4Src);
                            $(document.getElementById('sel4_cb')).hide();
                        }                    
                    } else if ($(this).attr('id') === 'sel5') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png') {
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-on.png';
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rw-toenail-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rw-straps-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rw-clips-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            $(this).attr('src',sel5Src);
                            $(document.getElementById('sel5_cb')).show();
                            $(otherElement1).attr('src', sel1Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(otherElement2).attr('src', sel2Src);
                            $(document.getElementById('sel2_cb')).hide();
                            $(otherElement3).attr('src', sel3Src);
                            $(document.getElementById('sel3_cb')).hide();
                            $(otherElement4).attr('src', sel4Src);
                            $(document.getElementById('sel4_cb')).hide();
                        } else {
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src', sel5Src);
                            $(document.getElementById('sel5_cb')).hide();
                        }                    
                    }
                }
            });
        </script>

    </body>
</html>
