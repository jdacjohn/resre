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
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Roof Deck Attachment - B</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/rdeckattachB.css" rel='stylesheet' type='text/css' media="all" />
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
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">8</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Roof Deck Attachment - B</h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    Now that you have identified the type of nails, you will need to determine the spacing between the nails. 
                                    If you see two shiners in a row you can measure the distance between them to determine your spacing or 
                                    if you have a stud finder you can mark the nails and then measure the spacing.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <div class="chars-border-middle-wt-4"></div>
                                <div class="chars-border-middle-wt-4a"></div>
                                <!-- RADIOS -->
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdab__" value="6" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/rda-6inch.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        6 inch spacing
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdab__" value="12" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/rda-12inch.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        12 inch spacing
                                    </div>
                                </div>
                                <div class="clear hidden-xs"></div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="other" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/other-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Other
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="unknown" />
                                        <img id="sel4" src="<?php echo SITE_ROOT; ?>/us/images/unknown-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel4_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
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
                $back = 'roof-deck-attach-A';
                $continue = 'water-barrier';
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
                    }
                }
            });
        </script>
    </body>
</html>
