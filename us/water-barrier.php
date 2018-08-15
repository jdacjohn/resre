<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');
    
    $mitigants = new resre\ResReMitigators();
    $home = new resre\ResReHome;

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
    $selected =  $mitigants->getWaterBarrier()->getMitKey();

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
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-sel.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/water-barrier.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body class="bg-blue">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner" id="charSelectPanel">
                <div class="characteristics-wrapper container">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="wbForm" id="wbForm" action="<?php echo HOME_LINK; ?>_includes/procCrit/procUSWaterBarrier.php">
                            <input type="hidden" name="postFrom" id="postFrom" value="__us-WB__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />

                            <div class="row">  <!-- Step number and page heading -->
                                <div class="col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">9</span></div>
                                <div class="col-xs-10 topic"><h4 class="chars-h4">Water Barrier<h4></div>
                            </div>
                            <div class="row">  <!-- Page Description -->
                                <div class="col-xs-2 chars-marker chars"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-xs-10 chars-desc white2025">
                                    Secondary water barriers are hard to identify without the original documentation that came with the roof. A 
                                    closed-cell adhesive can be identified from within the attic but they are easy to confuse with foam insulation 
                                    used for energy savings.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">  <!-- Select buttons -->
                                <!-- RADIOS -->
                                <!-- Closed Cell Spray Foam -->
                                <div class="col-xs-2">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-wb__" value="swryscc" selected />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/wb-ccspf-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Spray Foam
                                        </p>
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>

                                <!-- Adhesive Tape -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-wb__" value="swryssa" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/wb-flashtape-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Flash Tape
                                        </p>
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                                
                                <!-- None -->
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-wb__" value="swrno" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/wb-none-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            None
                                        </p>
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
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
                $formId = 'wbForm';
                require($root . 'includes/ccSave.php'); 
            ?>
        </div>   <!-- / .containter -->
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Image Preloads -->
        <div id="preload">
            <img src="<?php echo SITE_ROOT; ?>/us/images/wb-ccspf-on.png" height="1" alt="Closed Cell Spray Foam Water Barrier" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/wb-flashtape-on.png" height="1" alt="Flash Tape Water Barrier" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/wb-none-on.png" height="1" alt="No Water Barrier" />
        </div>
        <!-- Modals -->
        <?php 
           $action = SITE_ROOT . '/_includes/procCrit/procUSWaterBarrier.php';
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
                    if (selection === 'swryscc') {
                        console.log('Closed Cell');
                        $(document.getElementById('sel1')).click();
                    }
                    if (selection === 'swryssa') {
                        console.log('Self-Adhering');
                        $(document.getElementById('sel2')).click();
                    }
                    if (selection === 'swrno') {
                        console.log('No Secondary Water Barrier');
                        $(document.getElementById('sel3')).click();
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
                 $(document.getElementById('postFrom')).val('__us-WB-back__');
                 $("#wbForm").submit(); 
            });
            $("#saveBtn").click(function() {
                 $(document.getElementById('postFrom')).val('__us-WB-save__');
                 $("#wbForm").submit(); 
            });
            
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
