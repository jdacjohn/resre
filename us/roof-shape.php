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
    $selected =  $mitigants->getRoofShape()->getMitKey();    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Load site meta information -->
        <?php include($root . 'includes/page-head-meta.php'); ?>
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Roof</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-sel.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/roof.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body class="bg-blue">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner" id="charSelectPanel">
                <div class="characteristics-wrapper container">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="roofForm" id="roofForm" action="<?php echo HOME_LINK; ?>_includes/procCrit/procUSRoofShape.php">
                            <input type="hidden" name="postFrom" id="postFrom" value="__us-roofshape__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />

                            <div class="row">  <!-- Marker number and page header -->
                                <div class="col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">4</span></div>
                                <div class="col-xs-10 topic"><h4 class="chars-h4">Roof Shape</h4></div>
                            </div>
                            <div class="row">  <!-- Page description -->
                                <div class="col-xs-2 chars-marker chars"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-xs-10 chars-desc white2025">
                                    The type and shape of your home's roof can influence how well the roof will withstand high winds.  A hipped 
                                    roof slopes upward from all sides of the building and its aerodynamic shape helps it perform better.  A gabled 
                                    roof has two slopes that come together to form a ridge or peak at the top, making each end look like the letter A.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">  <!-- Select Buttons -->
                                <!-- RADIOS -->
                                <!-- Gable Roof -->
                                <div class="col-xs-2">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-roof__" value="rsgab" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/gable-roof-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Gable Roof
                                        </p>
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>

                                <!-- Hipped Roof -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-roof__" value="rship" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/hipped-roof-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Hipped Roof
                                        </p>
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                                
                                <!-- Combination Roof -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-roof__" value="rscombo" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/combo-roof-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Hipped &amp; Gabled
                                        </p>
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>

                                <!-- Other Roof -->
                                <div class="col-xs-2">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-roof__" value="rsOther" />
                                        <img id="sel4" src="<?php echo SITE_ROOT; ?>/us/images/other-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Other
                                        </p>
                                    </label>
                                    <div id="sel4_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>

                                <!-- Unknown Roof -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-roof__" value="rsUnknown" />
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
                $formId = 'roofForm';
                require($root . 'includes/ccSave.php'); 
            ?>
        </div>   <!-- / .containter -->

        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Image Preloads -->
        <div id="preload">
            <img src="<?php echo SITE_ROOT; ?>/us/images/gable-roof-on.png" height="1" alt="Gable Roof" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/hipped-roof-on.png" height="1" alt="Hipped Roof" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/combo-roof-on.png" height="1" alt="Combination Roof" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/other-on.png" height="1" alt="Other Roof Shape" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/unknown-on.png" height="1" alt="Unknown Roof Shape" />
        </div>
        <!-- Modals -->
        <?php
            $action = SITE_ROOT . '/_includes/procCrit/procUSRoofShape.php';
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
                    if (selection === 'rsgab') {
                        console.log('Gable Roof');
                        $(document.getElementById('sel1')).click();
                    }
                    if (selection === 'rship') {
                        console.log('Hipped Roof');
                        $(document.getElementById('sel2')).click();
                    }
                    if (selection === 'rsgabcmb') {
                        console.log('Combination Hip and Gable');
                        $(document.getElementById('sel3')).click();
                    }
                    if (selection === 'other') {
                        console.log('Other Roof Shape');
                        $(document.getElementById('sel4')).click();
                    }
                    if (selection === 'unknown') {
                        console.log('Unknown Roof Shape');
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
                 $(document.getElementById('postFrom')).val('__us-roofshape-back__');
                 $("#roofForm").submit(); 
            });
            $("#saveBtn").click(function() {
                $(document.getElementById('postFrom')).val('__us-roofshape-save__');
                $("#roofForm").submit();
            });

            $('img').on({
                'click': function() {
                    var sel1ImageSrc;
                    var sel2ImageSrc;
                    var sel3ImageSrc;
                    var sel4ImageSrc;
                    var sel5ImageSrc;
                    if ($(this).attr('id') === 'sel1') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel2');
                        var otherElement2 = document.getElementById('sel3');
                        var otherElement3 = document.getElementById('sel4');
                        var otherElement4 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/gable-roof-off.png') {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/gable-roof-on.png';
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hipped-roof-off.png';
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/combo-roof-off.png';
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel5ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel1ImageSrc);
                            $(otherElement1).attr('src',sel2ImageSrc);
                            $(otherElement2).attr('src',sel3ImageSrc);
                            $(otherElement3).attr('src',sel4ImageSrc);
                            $(otherElement4).attr('src',sel5ImageSrc);
                            $(document.getElementById('sel1_cb')).show();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/gable-roof-off.png';
                            $(this).attr('src', sel1ImageSrc);
                            $(document.getElementById('sel1_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel2') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel3');
                        var otherElement3 = document.getElementById('sel4');
                        var otherElement4 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/hipped-roof-off.png') {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/gable-roof-off.png';
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hipped-roof-on.png';
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/combo-roof-off.png';
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel5ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel2ImageSrc);
                            $(otherElement1).attr('src',sel1ImageSrc);
                            $(otherElement2).attr('src',sel3ImageSrc);
                            $(otherElement3).attr('src',sel4ImageSrc);
                            $(otherElement4).attr('src',sel5ImageSrc);
                            $(document.getElementById('sel2_cb')).show();
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hipped-roof-off.png';
                            $(this).attr('src', sel2ImageSrc);
                            $(document.getElementById('sel2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel3') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel4');
                        var otherElement4 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/combo-roof-off.png') {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/gable-roof-off.png';
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hipped-roof-off.png';
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/combo-roof-on.png';
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel5ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel3ImageSrc);
                            $(otherElement1).attr('src',sel1ImageSrc);
                            $(otherElement2).attr('src',sel2ImageSrc);
                            $(otherElement3).attr('src',sel4ImageSrc);
                            $(otherElement4).attr('src',sel5ImageSrc);
                            $(document.getElementById('sel3_cb')).show();
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/combo-roof-off.png';
                            $(this).attr('src', sel3ImageSrc);
                            $(document.getElementById('sel3_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel4') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/other-off.png') {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/gable-roof-off.png';
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hipped-roof-off.png';
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/combo-roof-off.png';
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/other-on.png';
                            sel5ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel4ImageSrc);
                            $(otherElement1).attr('src',sel1ImageSrc);
                            $(otherElement2).attr('src',sel2ImageSrc);
                            $(otherElement3).attr('src',sel3ImageSrc);
                            $(otherElement4).attr('src',sel5ImageSrc);
                            $(document.getElementById('sel4_cb')).show();
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src', sel4ImageSrc);
                            $(document.getElementById('sel4_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel5') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        var otherElement4 = document.getElementById('sel4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png') {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/gable-roof-off.png';
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hipped-roof-off.png';
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/combo-roof-off.png';
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel5ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-on.png';
                            $(this).attr('src',sel5ImageSrc);
                            $(otherElement1).attr('src',sel1ImageSrc);
                            $(otherElement2).attr('src',sel2ImageSrc);
                            $(otherElement3).attr('src',sel3ImageSrc);
                            $(otherElement4).attr('src',sel4ImageSrc);
                            $(document.getElementById('sel5_cb')).show();
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                        } else {
                            sel5ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src', sel5ImageSrc);
                            $(document.getElementById('sel5_cb')).hide();
                        }
                    }
                }
            });
        </script>

    </body>
</html>
