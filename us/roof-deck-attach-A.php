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
    $selected =  $mitigants->getRdaA()->getMitKey();
    
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
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-sel.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/rdeckattach.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body class="bg-blue">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner" id="charSelectPanel">
                <div class="characteristics-wrapper container">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="rdaAForm" id="rdaAForm" action="<?php echo HOME_LINK; ?>_includes/procCrit/procUS-RDA-A.php">
                            <input type="hidden" name="postFrom" id="postFrom" value="__us-RDA-A__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />

                            <div class="row">  <!-- Step number and page heading -->
                                <div class="col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">7</span></div>
                                <div class="col-xs-10 topic"><h4 class="chars-h4">Roof Deck Attachment - A</h4></div>
                            </div>
                            <div class="row">  <!-- Page description -->
                                <div class="col-xs-2 chars-marker chars"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-xs-10 chars-desc white2025">
                                    To determine the type of nails use a flashlight to look for shiners (nails that missed the rafters) along the 
                                    area where the framing meets the roof deck.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">  <!-- Select buttons -->
                                <!-- RADIOS -->
                                <!-- 6d Nail -->
                                <div class="col-xs-2">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="rda6d" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            6d Nail
                                        </p>
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                                
                                <!-- 8d Nail -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="rda8d" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            8d Nail
                                        </p>
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>

                                <!-- 10d Nail -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="rda10d" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            10d Nail
                                        </p>
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>

                                <!-- 6d and 8d Nails -->
                                <div class="col-xs-2">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="rda6s" />
                                        <img id="sel4" src="<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            6d and 8d Nails
                                        </p>
                                    </label>
                                    <div id="sel4_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>

                                <!-- Other -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="other" />
                                        <img id="sel5" src="<?php echo SITE_ROOT; ?>/us/images/other-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Other
                                        </p>
                                    </label>
                                    <div id="sel5_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>

                                <!-- Unknown -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rdaa__" value="unknown" />
                                        <img id="sel6" src="<?php echo SITE_ROOT; ?>/us/images/unknown-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Unknown
                                        </p>
                                    </label>
                                    <div id="sel6_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                            </div>
                        </form>
                    </div> <!-- wt-content-wrapper -->
                </div> <!-- ./ characteristics wrapper -->
            </div> <!-- ./ characteristics-inner -->
        </div> <!-- ./ characteristics Container

        <!-- Continue Cancel -->
        <div class="bottom-nav">
            <?php
                $formId = 'rdaAForm';
                require($root . 'includes/ccSave.php'); 
            ?>
        </div>   <!-- / .containter -->
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Image Preloads -->
        <div id="preload">
            <img src="<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-on.png" height="1" alt="6d nail Roof-Deck Attachment" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-on.png" height="1" alt="8d nail Roof-Deck Attachment" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-on.png" height="1" alt="10d nail Roof-Deck Attachment" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-on.png" height="1" alt="6d and 8d nail Roof-Deck Attachment" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/other-on.png" height="1" alt="Other type nail Roof-Deck Attachment" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/unknown-on.png" height="1" alt="Unknow type nail Roof-Deck Attachment" />
        </div>
        <!-- Modals -->
        <?php 
            $action = SITE_ROOT . '/_includes/procCrit/procUS-RDA-A.php';
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
                    if (selection === 'rda6d') {
                        console.log('6D Nail');
                        $(document.getElementById('sel1')).click();
                    }
                    if (selection === 'rda8s') {
                        console.log('8D Nail');
                        $(document.getElementById('sel2')).click();
                    }
                    if (selection === 'rda10d') {
                        console.log('10d Nails');
                        $(document.getElementById('sel3')).click();
                    }
                    if (selection === 'rda6s') {
                        console.log('6d and 8d Nails');
                        $(document.getElementById('sel4')).click();
                    }
                    if (selection === 'other') {
                        console.log('Other');
                        $(document.getElementById('sel5')).click();
                    }
                    if (selection === 'unknown') {
                        console.log('Unknown');
                        $(document.getElementById('sel6')).click();
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
                 $(document.getElementById('postFrom')).val('__us-RDA-A-back__');
                 $("#rdaAForm").submit(); 
            });
            $("#saveBtn").click(function() {
                 $(document.getElementById('postFrom')).val('__us-RDA-A-save__');
                 $("#rdaAForm").submit(); 
            });
            
            $('img').on({
                'click': function() {
                    var sel1Src;
                    var sel2Src;
                    var sel3Src;
                    var sel4Src;
                    var sel5Src;
                    var sel6Src;
                    if ($(this).attr('id') === 'sel1') {
                       var src = $(this).attr('src');
                       var element = document.getElementById('sel1_cb');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel4');
                        var otherElement5 = document.getElementById('sel5');
                        var otherElement6 = document.getElementById('sel6');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-off.png') {
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-on.png';
                            $(document.getElementById('sel1_cb')).show();
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-off.png';
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel1Src);
                            $(otherElement2).attr('src',sel2Src);
                            $(otherElement3).attr('src',sel3Src);
                            $(otherElement4).attr('src',sel4Src);
                            $(otherElement5).attr('src',sel5Src);
                            $(otherElement6).attr('src',sel6Src);
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                            $(document.getElementById('sel6_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-off.png';
                            $(this).attr('src', sel1Src);
                            $(document.getElementById('sel1_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel2') {
                       var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel4');
                        var otherElement5 = document.getElementById('sel5');
                        var otherElement6 = document.getElementById('sel6');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-off.png') {
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-on.png';
                            $(document.getElementById('sel2_cb')).show();
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-off.png';
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel2Src);
                            $(otherElement1).attr('src',sel1Src);
                            $(otherElement3).attr('src',sel3Src);
                            $(otherElement4).attr('src',sel4Src);
                            $(otherElement5).attr('src',sel5Src);
                            $(otherElement6).attr('src',sel6Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                            $(document.getElementById('sel6_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-off.png';
                            $(this).attr('src', sel2Src);
                            $(document.getElementById('sel2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel3') {
                       var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement4 = document.getElementById('sel4');
                        var otherElement5 = document.getElementById('sel5');
                        var otherElement6 = document.getElementById('sel6');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-off.png') {
                            // User selected this option
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-on.png';
                            $(document.getElementById('sel3_cb')).show();
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-off.png';
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel3Src);
                            $(otherElement1).attr('src',sel1Src);
                            $(otherElement2).attr('src',sel2Src);
                            $(otherElement4).attr('src',sel4Src);
                            $(otherElement5).attr('src',sel5Src);
                            $(otherElement6).attr('src',sel6Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                            $(document.getElementById('sel6_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-off.png';
                            $(this).attr('src', sel3Src);
                            $(document.getElementById('sel3_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel4') {
                       var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement5 = document.getElementById('sel5');
                        var otherElement6 = document.getElementById('sel6');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-off.png') {
                            // User selected this option
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-on.png';
                            $(document.getElementById('sel4_cb')).show();
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-off.png';
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel4Src);
                            $(otherElement1).attr('src',sel1Src);
                            $(otherElement2).attr('src',sel2Src);
                            $(otherElement3).attr('src',sel3Src);
                            $(otherElement5).attr('src',sel5Src);
                            $(otherElement6).attr('src',sel6Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                            $(document.getElementById('sel6_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-off.png';
                            $(this).attr('src', sel4Src);
                            $(document.getElementById('sel4_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel5') {
                       var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel4');
                        var otherElement6 = document.getElementById('sel6');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/other-off.png') {
                            // User selected this option
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-on.png';
                            $(document.getElementById('sel5_cb')).show();
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel5Src);
                            $(otherElement1).attr('src',sel1Src);
                            $(otherElement2).attr('src',sel2Src);
                            $(otherElement3).attr('src',sel3Src);
                            $(otherElement4).attr('src',sel4Src);
                            $(otherElement6).attr('src',sel6Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel6_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            $(this).attr('src', sel5Src);
                            $(document.getElementById('sel5_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel6') {
                       var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel4');
                        var otherElement5 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png') {
                            // User selected this option
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-on.png';
                            $(document.getElementById('sel6_cb')).show();
                            sel1Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d-nail-off.png';
                            sel2Src = '<?php echo SITE_ROOT; ?>/us/images/rda-8d-nail-off.png';
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/rda-10d-nail-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/rda-6d8d-nail-off.png';
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            $(this).attr('src',sel6Src);
                            $(otherElement1).attr('src',sel1Src);
                            $(otherElement2).attr('src',sel2Src);
                            $(otherElement3).attr('src',sel3Src);
                            $(otherElement4).attr('src',sel4Src);
                            $(otherElement5).attr('src',sel5Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            // Unselecting current selection
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src', sel6Src);
                            $(document.getElementById('sel6_cb')).hide();
                        }
                    }
                }
            });
        </script>

    </body>
</html>
