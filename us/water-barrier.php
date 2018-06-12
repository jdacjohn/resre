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
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Water Barrier</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/water-barrier.css" rel='stylesheet' type='text/css' media="all" />
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
                        <form method="post" name="rdaBForm" action="<?php echo HOME_LINK; ?>us/water-barrier.php">
                            <input type="hidden" name="postFrom" value="__usRDA-B__" />
                            <input type="hidden" name="imgFile" value="" />

                            <div class="row">
                                <div class="chars-border-middle-wt-1"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">9</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Water Barrier<h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    Secondary water barriers are hard to identify without the original documentation that came with the roof. A 
                                    closed-cell adhesive can be identified from within the attic but they are easy to confuse with foam insulation 
                                    used for energy savings.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <div class="chars-border-middle-wt-4"></div>
                                <!-- RADIOS -->
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3 chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdab__" value="6" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/wb-ccspf-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        Closed Cell Spray<br />Polyurethane Foam
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdab__" value="12" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/wb-flashtape-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        Self-Adhering<br />Flashing Tape
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="other" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/wb-none-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        No Secondary Water<br />Barrier Installed
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
                $back = 'roof-deck-attach-B';
                $continue = 'complete';
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
                    if ($(this).attr('id') === 'sel1') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel2');
                        var otherElement2 = document.getElementById('sel3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/wb-ccspf-off.png') {
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/wb-ccspf-on.png';
                            $(document.getElementById('sel1_cb')).show();
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/wb-flashtape-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/wb-none-off.png';
                            $(this).attr('src',sel1Src);
                            $(otherElement1).attr('src',sel2Src);
                            $(otherElement2).attr('src',sel3Src);
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                        } else {
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/wb-ccspf-off.png';
                            $(this).attr('src', sel1Src);
                            $(document.getElementById('sel1_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel2') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/wb-flashtape-off.png') {
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/wb-flashtape-on.png';
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/wb-ccspf-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/wb-none-off.png';
                            $(this).attr('src',sel2Src);
                            $(otherElement1).attr('src', sel1Src);
                            $(otherElement2).attr('src', sel3Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).show();
                            $(document.getElementById('sel3_cb')).hide();
                        } else {
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/wb-flashtape-off.png';
                            $(this).attr('src', sel2Src);
                            $(document.getElementById('sel2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel3') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/wb-none-off.png') {
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/wb-none-on.png';
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/wb-ccspf-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/wb-flashtape-off.png';
                            $(this).attr('src',sel3Src);
                            $(otherElement1).attr('src', sel1Src);
                            $(otherElement2).attr('src', sel2Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).show();
                        } else {
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/wb-none-off.png';
                            $(this).attr('src', sel3Src);
                            $(document.getElementById('sel3_cb')).hide();
                        }                    
                    }
                }
            });
        </script>

    </body>
</html>
