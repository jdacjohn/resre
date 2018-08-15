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
    $selected =  $mitigants->getRoofToWall()->getMitKey();
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
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-sel.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/roofWall.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body class="bg-blue">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner" id="charSelectPanel">
                <div class="characteristics-wrapper container">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="roofWallForm" id="roofWallForm" action="<?php echo HOME_LINK; ?>_includes/procCrit/procUSRoofWall.php">
                            <input type="hidden" name="postFrom" id="postFrom" value="__us-roofwall__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />

                            <div class="row">  <!--Step Number and Page Heading -->
                                <div class="col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">6</span></div>
                                <div class="col-xs-10 topic"><h4 class="chars-h4">Roof to Wall Connections</h4></div>
                            </div>
                            <div class="row">  <!-- Page Description -->
                                <div class="col-xs-2 chars-marker chars"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-xs-10 chars-desc white2025">
                                    Your home's ability to resist the extreme force of wind is only as strong as it weakest link. To determine your 
                                    type of connections, go into the attic and look along where the framing members meet the wall of your home. 
                                    Sometimes you can see the reflection of the straps or clips with the use of a flashlight.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">  <!-- Selection Buttons -->
                                <!-- RADIOS -->
                                <!-- Toe-Nail Construction -->
                                <div class="col-xs-2">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="tnail" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/rw-toenail-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Toe-Nail
                                        </p>
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                                
                                <!-- Straps -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="strap" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/rw-straps-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Straps
                                        </p>
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                                
                                <!-- Clips -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="clip" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/rw-clips-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Clips
                                        </p>
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                                
                                <!-- Other -->
                                <div class="col-xs-2">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="other" />
                                        <img id="sel4" src="<?php echo SITE_ROOT; ?>/us/images/other-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Other
                                        </p>
                                    </label>
                                    <div id="sel4_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                                
                                <!-- Unknown -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-rwall__" value="unknown" />
                                        <img id="sel5" src="<?php echo SITE_ROOT; ?>/us/images/unknown-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Unknown
                                        </p>
                                    </label>
                                    <div id="sel5_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
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
                $formId = 'roofWallForm';
                require($root . 'includes/ccSave.php'); 
            ?>
        </div>   <!-- / .containter -->
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Image Preloads -->
        <div id="preload">
            <img src="<?php echo SITE_ROOT; ?>/us/images/rw-toenail-on.png" height="1" alt="Toenail Roof to Wall Connections" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/rw-straps-on.png" height="1" alt="Strap Roof to Wall Connections" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/rw-clips-on.png" height="1" alt="Clip Roof to Wall Connections" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/other-on.png" height="1" alt="Other Roof to Wall Connections" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/unknown-on.png" height="1" alt="Unknown Roof to Wall Connections" />
        </div>
        <!-- Modals -->
        <?php 
            $action = SITE_ROOT . '/_includes/procCrit/procUSRoofWall.php';
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
                    if (selection === 'tnail') {
                        console.log('Toe-Nail Connectiions');
                        $(document.getElementById('sel1')).click();
                    }
                    if (selection === 'straps') {
                        console.log('Strap Connectors');
                        $(document.getElementById('sel2')).click();
                    }
                    if (selection === 'clips') {
                        console.log('Clip Connectors');
                        $(document.getElementById('sel3')).click();
                    }
                    if (selection === 'other') {
                        console.log('Other');
                        $(document.getElementById('sel4')).click();
                    }
                    if (selection === 'unknown') {
                        console.log('Unknown');
                        $(document.getElementById('sel5')).click();
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
                 $(document.getElementById('postFrom')).val('__us-roofwall-back__');
                 $("#roofWallForm").submit(); 
            });
            $("#saveBtn").click(function() {
                 $(document.getElementById('postFrom')).val('__us-roofwall-save__');
                 $("#roofWallForm").submit(); 
            });
            
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
