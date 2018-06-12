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
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Roof Deck Attachment - A</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/rdeckattach.css" rel='stylesheet' type='text/css' media="all" />
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
                        <form method="post" name="rdaAForm" action="<?php echo HOME_LINK; ?>us/roof-deck-attach-A.php">
                            <input type="hidden" name="postFrom" value="__usRDA-A__" />
                            <input type="hidden" name="imgFile" value="" />

                            <div class="row">
                                <div class="chars-border-middle-wt-1"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">7</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Roof Deck Attachment - A</h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    To determine the type of nails use a flashlight to look for shiners (nails that missed the rafters) along the 
                                    area where the framing meets the roof deck.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <div class="chars-border-middle-wt-4"></div>
                                <div class="chars-border-middle-wt-4a"></div>
                                <div class="chars-border-middle-wt-4b"></div>
                                <div class="chars-border-middle-wt-4c"></div>
                                <!-- RADIOS -->
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3 chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="rda6d" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer  white2025Bold">
                                        6d Nail
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="rda8d" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer  white2025Bold">
                                        8d Nail
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="rda10d" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        10d Nail
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3 chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="rda6s" />
                                        <img id="sel4" src="<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel4_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        6d and 8d Nails
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="other" />
                                        <img id="sel5" src="<?php echo SITE_ROOT; ?>/us/images/other-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel5_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 white2025Bold">
                                        Other
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="unknown" />
                                        <img id="sel6" src="<?php echo SITE_ROOT; ?>/us/images/unknown-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sel6_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
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
                $back = 'roof-wall';
                $continue = 'roof-deck-attach-B';
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
                    if ($(this).attr('id') === 'sel1') {
                        var element = document.getElementById('sel1_cb');
                        if ($(element).is(':visible')) {
                            $(element).hide();
                        } else {
                            $(element).show();
                        }
                        $(document.getElementById('sel2_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                        $(document.getElementById('sel5_cb')).hide();
                        $(document.getElementById('sel6_cb')).hide();
                    } else if ($(this).attr('id') === 'sel2') {
                        var element = document.getElementById('sel2_cb');
                        if ($(element).is(':visible')) {
                            $(element).hide();
                        } else {
                            $(element).show();
                        }
                        $(document.getElementById('sel1_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                        $(document.getElementById('sel5_cb')).hide();
                        $(document.getElementById('sel6_cb')).hide();
                    } else if ($(this).attr('id') === 'sel3') {
                        var element = document.getElementById('sel3_cb');
                        if ($(element).is(':visible')) {
                            $(element).hide();
                        } else {
                            $(element).show();
                        }
                        $(document.getElementById('sel1_cb')).hide();
                        $(document.getElementById('sel2_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                        $(document.getElementById('sel5_cb')).hide();
                        $(document.getElementById('sel6_cb')).hide();
                    } else if ($(this).attr('id') === 'sel4') {
                        var element = document.getElementById('sel4_cb');
                        if ($(element).is(':visible')) {
                            $(element).hide();
                        } else {
                            $(element).show();
                        }
                        $(document.getElementById('sel1_cb')).hide();
                        $(document.getElementById('sel2_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel5_cb')).hide();
                        $(document.getElementById('sel6_cb')).hide();
                    } else if ($(this).attr('id') === 'sel5') {
                        var element = document.getElementById('sel5_cb');
                        if ($(element).is(':visible')) {
                            $(element).hide();
                        } else {
                            $(element).show();
                        }
                        $(document.getElementById('sel1_cb')).hide();
                        $(document.getElementById('sel2_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                        $(document.getElementById('sel6_cb')).hide();
                    } else if ($(this).attr('id') === 'sel6') {
                        var element = document.getElementById('sel6_cb');
                        if ($(element).is(':visible')) {
                            $(element).hide();
                        } else {
                            $(element).show();
                        }
                        $(document.getElementById('sel1_cb')).hide();
                        $(document.getElementById('sel2_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                        $(document.getElementById('sel5_cb')).hide();
                    }
                }
            });
        </script>

    </body>
</html>
