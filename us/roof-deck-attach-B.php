<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');
    
    $mitigants = new resre\ResReMitigators();
    $home = new resre\ResReHome();

    // Get modal triggers and upload responses (if any) and clear them from the session for subsequent pages
    $response = isset($_SESSION[SESSION_NAME]['response']) ? $_SESSION[SESSION_NAME]['response'] : 0;
    // Now wipe the page so we don't show erroneous messages on subsequent pages
    unset($_SESSION[SESSION_NAME]['response']);
    $trigger = isset($_SESSION[SESSION_NAME]['trigger']) ? $_SESSION[SESSION_NAME]['trigger'] : '';
    // Now wipe the trigger so we don't hose subsequent pages
    unset($_SESSION[SESSION_NAME]['trigger']);
    
    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    }
    $selected =  $mitigants->getRdaB()->getMitKey();

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
    <body class="bg-blue">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner">
                <div class="characteristics-wrapper container half_padding_left half_padding_right">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="rdaBForm" id="rdaBForm" action="<?php echo HOME_LINK; ?>_includes/procCrit/procUS-RDA-B.php">
                            <input type="hidden" name="postFrom" id="postFrom" value="__us-RDA-B__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />

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
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/rda-6inch-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        6 inch spacing
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdab__" value="12" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/rda-12inch-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        12 inch spacing
                                    </div>
                                </div>
                                <div class="clear hidden-xs"></div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdab__" value="other" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/other-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Other
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdab__" value="unknown" />
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
                $formId = 'rdaBForm';
                require($root . 'includes/ccSave.php'); 
            ?>
        </div>   <!-- / .containter -->
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Image Preloads -->
        <div id="preload">
            <img src="<?php echo SITE_ROOT; ?>/us/images/rda-6inch-on.png" height="1" alt="6 Inch Roof Deck Attachment Nail Spacing" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/rda-12inch-on.png" height="1" alt="12 Inch Roof Deck Attachment Nail Spacing" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/other-on.png" height="1" alt="Other Roof-Deck Attachment Nail Spacing" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/unknown-on.png" height="1" alt="Unknow Roof-Deck Attachment Nail Spacing" />
        </div>
        <!-- Modals -->
        <?php
           $action = SITE_ROOT . '/_includes/procCrit/procUS-RDA-B.php';
            require($root . 'includes/modals/upload.php');
            require($root . 'includes/modals/dataSave.php');
        ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>
        <!-- Image swap functions for selections -->
        <script>
            $(window ).on({
                'load': function() {
                    $(window).attr('innerDocClick', false);
                    var selection = $(document.getElementById('postBack')).attr('value');
                    console.log("selection = " + selection);
                    if (selection === 'rdab6') {
                        console.log('6 Inch Spacing');
                        $(document.getElementById('sel1')).click();
                    }
                    if (selection === 'rdab12') {
                        console.log('12 Inch Spacing');
                        $(document.getElementById('sel2')).click();
                    }
                    if (selection === 'other') {
                        console.log('Other Spacing');
                        $(document.getElementById('sel3')).click();
                    }
                    if (selection === 'unknown') {
                        console.log('Unknown Spacing');
                        $(document.getElementById('sel4')).click();
                    }
                    if (selection === '') {
                        console.log('No selection yet.');
                    }
                    var trigger = $(document.getElementById('trigger')).attr('value');
                    if (trigger === 'dataSaved') {
                        $("#dataSavedModal").modal('toggle');
                    }
                }
            });

            $("#moveBack").click(function() {
                 $(document.getElementById('postFrom')).val('__us-RDA-B-back__');
                 $("#rdaBForm").submit(); 
            });
            $("#saveBtn").click(function() {
                 $(document.getElementById('postFrom')).val('__us-RDA-B-save__');
                 $("#rdaBForm").submit(); 
            });
            
            $('img').on({
                'click': function() {
                    var sel1Src;
                    var sel2Src;
                    var sel3Src;
                    var sel4Src;
                    if ($(this).attr('id') === 'sel1') {
                       var src = $(this).attr('src');
                       var element = document.getElementById('sel1_cb');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/rda-6inch-off.png') {
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6inch-on.png';
                            $(document.getElementById('sel1_cb')).show();
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-12inch-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel1Src);
                            $(otherElement2).attr('src',sel2Src);
                            $(otherElement3).attr('src',sel3Src);
                            $(otherElement4).attr('src',sel4Src);
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6inch-off.png';
                            $(this).attr('src', sel1Src);
                            $(document.getElementById('sel1_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel2') {
                       var src = $(this).attr('src');
                       var element = document.getElementById('sel2_cb');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/rda-12inch-off.png') {
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-12inch-on.png';
                            $(document.getElementById('sel2_cb')).show();
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6inch-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel2Src);
                            $(otherElement1).attr('src',sel1Src);
                            $(otherElement3).attr('src',sel3Src);
                            $(otherElement4).attr('src',sel4Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-12inch-off.png';
                            $(this).attr('src', sel2Src);
                            $(document.getElementById('sel2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel3') {
                       var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement4 = document.getElementById('sel4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/other-off.png') {
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-on.png';
                            $(document.getElementById('sel3_cb')).show();
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6inch-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-12inch-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel3Src);
                            $(otherElement1).attr('src',sel1Src);
                            $(otherElement2).attr('src',sel2Src);
                            $(otherElement4).attr('src',sel4Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            $(this).attr('src', sel3Src);
                            $(document.getElementById('sel3_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel4') {
                       var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png') {
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-on.png';
                            $(document.getElementById('sel4_cb')).show();
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6inch-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-12inch-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            $(this).attr('src',sel4Src);
                            $(otherElement1).attr('src',sel1Src);
                            $(otherElement2).attr('src',sel2Src);
                            $(otherElement3).attr('src',sel3Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src', sel4Src);
                            $(document.getElementById('sel4_cb')).hide();
                        }
                    }
                }
            });
        </script>
    </body>
</html>
