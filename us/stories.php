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
        <link href="<?php echo $root; ?>css/stories.css" rel='stylesheet' type='text/css' media="all" />
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
                        <form method="post" name="storiesForm" action="<?php echo HOME_LINK; ?>us/wall-types.php">
                            <input type="hidden" name="postFrom" value="__usstories__" />
                            <input type="hidden" name="imgFile" value="" />
                            <div class="row">
                                <div class="chars-border-middle-wt-1"></div>                                
                                <div class="lineStopTop hidden-xs"></div>
                                <div class="lineStopBot hidden-xs"></div>
                                <div class="col-md-12 col-xs-12 hidden-xs chars-header-text white3040">
                                    Creating your own personalized inspection report and damage simulation is easy.  Scroll down to start!
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Stories</h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    A one-story home has only one level defined as the ground floor. A one-story home with a loft of any area with a living space 
                                    between the ceiling of the ground floor and the roof is considered two stories.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <!-- RADIOS -->
                                <!-- <div class="col-md-2 col-sm-2 hidden-xs chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div> -->
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-walltype__" value="F1" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/one-story-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        One story house
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-walltype__" value="F2" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/two-story-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Two or more stories
                                    </div>
                                </div>
                                <div class="clear hidden-xs"></div>
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
                $back = 'loc';
                $continue = 'wall-types';
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
                    var twoImageSrc;
                    var singleImageSrc;
                    if ($(this).attr('id') === 'sto2') {
                        var src = $(this).attr('src');
                        var otherElement = document.getElementById('sto1');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/two-story-off.png') {
                            twoImageSrc = '<?php echo SITE_ROOT; ?>/us/images/two-story-on.png';
                            $(document.getElementById('sto2_cb')).show();
                            singleImageSrc = '<?php echo SITE_ROOT; ?>/us/images/one-story-off.png';
                            $(this).attr('src',twoImageSrc);
                            $(otherElement).attr('src',singleImageSrc);
                            $(document.getElementById('sto1_cb')).hide();
                        } else {
                            twoImageSrc = '<?php echo SITE_ROOT; ?>/us/images/two-story-off.png';
                            $(this).attr('src', twoImageSrc);
                            $(document.getElementById('sto2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sto1') {
                        var src = $(this).attr('src');
                        var otherElement = document.getElementById('sto2');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/one-story-off.png') {
                            twoImageSrc = '<?php echo SITE_ROOT; ?>/us/images/two-story-off.png';
                            singleImageSrc = '<?php echo SITE_ROOT; ?>/us/images/one-story-on.png';
                            $(this).attr('src',singleImageSrc);
                            $(document.getElementById('sto1_cb')).show();
                            $(otherElement).attr('src', twoImageSrc);
                            $(document.getElementById('sto2_cb')).hide();
                        } else {
                            singleImageSrc = '<?php echo SITE_ROOT; ?>/us/images/one-story-off.png';
                            $(this).attr('src', singleImageSrc);
                            $(document.getElementById('sto1_cb')).hide();
                        }
                    }
                }
            });
        </script>
        
    </body>
</html>
