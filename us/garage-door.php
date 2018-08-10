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
    $selected =  $mitigants->getGarageDoor()->getCurVal();

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
    <body class="bg-blue">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner">
                <div class="characteristics-wrapper container half_padding_left half_padding_right">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="garageForm" id="garageForm" action="<?php echo HOME_LINK; ?>_includes/procCrit/procUSGarageDoor.php">
                            <input type="hidden" name="postFrom" id="postFrom" value="__us-garagedoor__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="garageSelect" id="garageSelect" value ="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />

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
                                <?php if ($mitigants->getShutters()->getCurVal() == 'shtys') { ?>
                                    <!-- Only show the impact and no garage door options -->
                                    <!-- Impact Rated Door (gdsup) -->
                                    <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                        <label class="select-button">
                                            <input type="radio" name="__chars-gdoor__" value="gdsup" />
                                            <img id="gdr1" src="<?php echo SITE_ROOT; ?>/us/images/garage-impact-off.png" class="img-responsive chars-select">
                                        </label>
                                        <div id="gdr1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                        <div class="chars-header chars-label chars-buffer white2025Bold">
                                            Impact Resistant
                                        </div>
                                    </div>

                                    <!-- No Garage Door (gdno2) -->
                                    <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                        <label class="select-button">
                                            <input type="radio" name="__chars-gdoor__" id="gdr4_rb" value="gdno2" />
                                            <img id="gdr4" src="<?php echo SITE_ROOT; ?>/us/images/no-garage-door-off.png" class="img-responsive chars-select">
                                        </label>
                                        <div id="gdr4_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                        <div class="chars-header chars-label white2025Bold">
                                            None
                                        </div>
                                    </div>
                                    
                                <?php } else { ?>
                                    
                                    <!-- Only show Standard, Weak, and No Garage Door option for No Shutters selection -->
                                    <!-- Wind Resistant Door (gdstd) -->
                                    <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                        <label class="select-button">
                                            <input type="radio" name="__chars-gdoor__" value="gdstd" />
                                            <img id="gdr2" src="<?php echo SITE_ROOT; ?>/us/images/garage-wind-off.png" class="img-responsive chars-select">
                                        </label>
                                        <div id="gdr2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                        <div class="chars-header chars-label chars-buffer white2025Bold">
                                            Wind Resistant
                                        </div>
                                    </div>
                                    
                                    <!-- Standard Garage Door (gdwdk) -->
                                    <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                        <label class="select-button">
                                            <input type="radio" name="__chars-gdoor__" value="gdwkd" />
                                            <img id="gdr3" src="<?php echo SITE_ROOT; ?>/us/images/garage-standard-off.png" class="img-responsive chars-select">
                                        </label>
                                        <div id="gdr3_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                        <div class="chars-header chars-label chars-buffer white2025Bold">
                                            Standard Door
                                        </div>
                                    </div>
                                    <div class="clear hidden-xs"></div>

                                    <!-- No Garage Door (gdnod) -->
                                    <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                        <label class="select-button">
                                            <input type="radio" name="__chars-gdoor__" id="gdr4_rb" value="gdnod" />
                                            <img id="gdr4" src="<?php echo SITE_ROOT; ?>/us/images/no-garage-door-off.png" class="img-responsive chars-select">
                                        </label>
                                        <div id="gdr4_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                        <div class="chars-header chars-label white2025Bold">
                                            None
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                            
                            <!-- Hack to clear radio button selection -->
                            <div style="display: none"><input type="radio" name="__chars-gdoor__" id="default" value="" /></div>
                            
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
                $formId = 'garageForm';
                require($root . 'includes/ccSave.php'); 
            ?>
        </div>   <!-- / .containter -->
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Image Preloads -->
        <div id="preload">
            <img src="<?php echo SITE_ROOT; ?>/us/images/garage-impact-on.png" height="1" alt="Impact Rated Garage Door" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/garage-wind-on.png" height="1" alt="Wind Rated Garage Door" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/garage-standard-on.png" height="1" alt="Standard Garage Door" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/no-garage-door-on.png" height="1" alt="No Garage Door" />
        </div>
        <!-- Modals -->
        <?php
            $action = SITE_ROOT . '/_includes/procCrit/procUSGarageDoor.php';
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
                    if (selection === 'gdsup') {
                        console.log('Impact Resistant Garage Door');
                        $(document.getElementById('gdr1')).click();
                    }
                    if (selection === 'gdstd') {
                        console.log('Wind Resistant Garage Door');
                        $(document.getElementById('gdr2')).click();
                    }
                    if (selection === 'gdwkd') {
                        console.log('Standard Garage Door');
                        $(document.getElementById('gdr3')).click();
                    }
                    if (selection === 'gdunk' || selection === 'gdno2' || selection === 'gdnod') {
                        console.log('Unknown');
                        $(document.getElementById('gdr4')).click();
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
                 $(document.getElementById('postFrom')).val('__us-garagedoor-back__');
                 $("#garageForm").submit(); 
            });
            $("#saveBtn").click(function() {
                 $(document.getElementById('postFrom')).val('__us-garagedoor-save__');
                 $("#garageForm").submit(); 
            });
            
            
            
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
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-garage-door-off.png';
                            $(this).attr('src',impactImageSrc);
                            $(otherElement1).attr('src',windImageSrc);
                            $(otherElement2).attr('src',standardImageSrc);
                            $(otherElement3).attr('src',unknownImageSrc);
                            $(document.getElementById('gdr2_cb')).hide();
                            $(document.getElementById('gdr3_cb')).hide();
                            $(document.getElementById('gdr4_cb')).hide();
                            $(document.getElementById('garageSelect')).attr('value', 'gdsup');
                        } else {
                            impactImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-impact-off.png';
                            $(this).attr('src', impactImageSrc);
                            $(document.getElementById('gdr1_cb')).hide();
                            $(document.getElementById('garageSelect')).attr('value', '');
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
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-garage-door-off.png';
                            $(this).attr('src',windImageSrc);
                            $(document.getElementById('gdr2_cb')).show();
                            $(otherElement1).attr('src', impactImageSrc);
                            $(document.getElementById('gdr1_cb')).hide();
                            $(otherElement2).attr('src', standardImageSrc);
                            $(document.getElementById('gdr3_cb')).hide();
                            $(otherElement3).attr('src', unknownImageSrc);
                            $(document.getElementById('gdr4_cb')).hide();
                            $(document.getElementById('garageSelect')).attr('value', 'gdstd');
                        } else {
                            windImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-wind-off.png';
                            $(this).attr('src', windImageSrc);
                            $(document.getElementById('gdr2_cb')).hide();
                            $(document.getElementById('garageSelect')).attr('value', '');
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
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-garage-door-off.png';
                            $(this).attr('src',standardImageSrc);
                            $(document.getElementById('gdr3_cb')).show();
                            $(otherElement1).attr('src', impactImageSrc);
                            $(document.getElementById('gdr1_cb')).hide();
                            $(otherElement2).attr('src', windImageSrc);
                            $(document.getElementById('gdr2_cb')).hide();
                            $(otherElement3).attr('src', unknownImageSrc);
                            $(document.getElementById('gdr4_cb')).hide();
                            $(document.getElementById('garageSelect')).attr('value', 'gdwkd');
                        } else {
                            standardImageSrc = '<?php echo SITE_ROOT; ?>/us/images/garage-standard-off.png';
                            $(this).attr('src', standardImageSrc);
                            $(document.getElementById('gdr3_cb')).hide();
                            $(document.getElementById('garageSelect')).attr('value', '');
                        }                    
                    } else if ($(this).attr('id') === 'gdr4') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('gdr1');
                        var otherElement2 = document.getElementById('gdr2');
                        var otherElement3 = document.getElementById('gdr3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/no-garage-door-off.png') {
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-garage-door-on.png';
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
                            $(document.getElementById('garageSelect')).attr('value', $(document.getElementById('gdr4_rb')).attr('value'));
                        } else {
                            unknownImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-garage-door-off.png';
                            $(this).attr('src', unknownImageSrc);
                            $(document.getElementById('gdr4_cb')).hide();
                            $(document.getElementById('garageSelect')).attr('value', '');
                        }                    
                    }
                }
            });
        </script>

    </body>
</html>
