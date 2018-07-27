<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');
    
    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    $mitigants = new resre\ResReMitigators();
    $home = new resre\ResReHome();
    $response = 0;
    $trigger = '';
    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    }
    $selected =  $mitigants->getShutters()->getMitKey();
    // Get the home object from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    }
    
    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-walltypes__') {
        // Save the base config for wall type.
        $mitigant = $mitigants->getWallType();
        $wallType = isset($_POST['__chars-walltype__']) ? $_POST['__chars-walltype__'] : '';
        switch ($wallType) {
            case 'WS':
                $mitigant->setCurVal($wallType);
                $mitigant->setOptimumVal($wallType);
                $mitigant->setMitKey(strtolower($wallType));
                $home->setNumberOfComponents(6);
                break;
            case 'rmfys':
                $mitigant->setCurVal('MS');
                $mitigant->setOptimumVal('MS');
                $mitigant->setMitKey($wallType);
                $home->setNumberOfComponents(7);
                break;
            case 'rmfno':
                $mitigant->setCurVal('MS');
                $mitigant->setOptimumVal('MS');
                $mitigant->setMitKey($wallType);
                $home->setNumberOfComponents(7);
                break;
            case 'unknown':
                $mitigant->setCurVal('WS');
                $mitigant->setOptimumVal('WS');
                $mitigant->setMitKey($wallType);
                $home->setNumberOfComponents(6);
                break;
        }
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/shutters/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $response = saveUserImage($fileName, $location, 'shutters');
        } else {
            $response = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
    } elseif ($postFrom == '__us-shutters__') {
        $newID = saveState($mitigants, $home);
        $trigger = 'dataSaved';
    }

    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    $_SESSION[SESSION_NAME]['home'] = serialize($home);
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session After Posting');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReHome');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Load site meta information -->
        <?php include($root . 'includes/page-head-meta.php'); ?>
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Shutters</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/shutters.css" rel='stylesheet' type='text/css' media="all" />
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
                        <form method="post" name="shuttersForm" id="shuttersForm" action="<?php echo HOME_LINK; ?>us/roof-shape.php">
                            <input type="hidden" name="postFrom" value="__us-shutters__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />

                            <div class="row">
                                <div class="chars-border-middle-wt-1"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">3</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Shutters</h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    Hurricane shutters are used to prevent windows from being broken by flying objects during a storm. For a 
                                    shutter to be rated as a hurricane shutter it must meet Miami-Dade TAS 201, 202, and 203, SSTD 12, or
                                    ASTM E 1886 & 1996 standards. Most shutters will have a stamp or be etched identifying it as impact rated.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <div class="chars-border-middle-wt-4"></div>
                                <!-- RADIOS -->
                                <!-- <div class="col-md-2 col-sm-2 hidden-xs chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div> -->
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-10 chars-header-x3 chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-shutters__" value="shtyshr" />
                                        <img id="sht1" src="<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sht1_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        Hurricane Rated
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-shutters__" value="shtysnr" />
                                        <img id="sht2" src="<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sht2_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 chars-buffer white2025Bold">
                                        Non-Rated
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-10 chars-header-x3">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-shutters__" value="shtno" />
                                        <img id="sht3" src="<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png" class="img-responsive chars-select-x3">
                                    </label>
                                    <div id="sht3_cb" class="col-xs-6 chars-checkbox-x3 fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label-x3 white2025Bold">
                                        No Shutters
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
                $formId = 'shuttersForm';
                require($root . 'includes/ccSave.php'); 
            ?>
        </div>   <!-- / .containter -->

        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Modals -->
        <?php
            require($root . 'includes/modals/upload.php');
            require($root . 'includes/modals/dataSave.php');
        ?>

        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>

        <!-- Image swap functions for selections -->
        <script>
            $(window ).on({
                'load': function() {
                    var selection = $(document.getElementById('postBack')).attr('value');
                    console.log("selection = " + selection);
                    if (selection === 'shtyshr') {
                        console.log('Hurricane Rated Shutters');
                        $(document.getElementById('sht1')).click();
                    }
                    if (selection === 'shtysnr') {
                        console.log('Non-Rated Shutters');
                        $(document.getElementById('sht2')).click();
                    }
                    if (selection === 'shtno') {
                        console.log('No Shutters');
                        $(document.getElementById('sht3')).click();
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
                 $("#shuttersForm").attr("action", "<?php echo HOME_LINK; ?>us/wall-types.php");
                 $("#shuttersForm").submit(); 
            });
            $("#saveBtn").click(function() {
                $("#shuttersForm").attr("action", "<?php echo HOME_LINK; ?>us/shutters.php");
                $("#shuttersForm").submit();
            });

            $('img').on({
                'click': function() {
                    var hurricaneImageSrc;
                    var nonRatedImageSrc;
                    var noShuttersImageSrc;
                    if ($(this).attr('id') === 'sht1') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sht2');
                        var otherElement2 = document.getElementById('sht3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png') {
                            hurricaneImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-on.png';
                            $(document.getElementById('sht1_cb')).show();
                            nonRatedImageSrc = '<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png';
                            noShuttersImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png';
                            $(this).attr('src',hurricaneImageSrc);
                            $(otherElement1).attr('src',nonRatedImageSrc);
                            $(otherElement2).attr('src',noShuttersImageSrc);
                            $(document.getElementById('sht2_cb')).hide();
                            $(document.getElementById('sht3_cb')).hide();
                        } else {
                            hurricaneImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png';
                            $(this).attr('src', hurricaneImageSrc);
                            $(document.getElementById('sht1_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sht2') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sht1');
                        var otherElement2 = document.getElementById('sht3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png') {
                            nonRatedImageSrc = '<?php echo SITE_ROOT; ?>/us/images/non-rated-on.png';
                            hurricaneImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png';
                            noShuttersImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png';
                            $(this).attr('src',nonRatedImageSrc);
                            $(document.getElementById('sht2_cb')).show();
                            $(otherElement1).attr('src', hurricaneImageSrc);
                            $(document.getElementById('sht1_cb')).hide();
                            $(otherElement2).attr('src', noShuttersImageSrc);
                            $(document.getElementById('sht3_cb')).hide();
                        } else {
                            nonRatedImageSrc = '<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png';
                            $(this).attr('src', nonRatedImageSrc);
                            $(document.getElementById('sht2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sht3') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sht1');
                        var otherElement2 = document.getElementById('sht2');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png') {
                            noShuttersImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-shutters-on.png';
                            hurricaneImageSrc = '<?php echo SITE_ROOT; ?>/us/images/hurricane-rated-off.png';
                            nonRatedImageSrc = '<?php echo SITE_ROOT; ?>/us/images/non-rated-off.png';
                            $(this).attr('src',noShuttersImageSrc);
                            $(document.getElementById('sht3_cb')).show();
                            $(otherElement1).attr('src', hurricaneImageSrc);
                            $(document.getElementById('sht1_cb')).hide();
                            $(otherElement2).attr('src', nonRatedImageSrc);
                            $(document.getElementById('sht2_cb')).hide();
                        } else {
                            noShuttersImageSrc = '<?php echo SITE_ROOT; ?>/us/images/no-shutters-off.png';
                            $(this).attr('src', noShuttersImageSrc);
                            $(document.getElementById('sht3_cb')).hide();
                        }                    
                    }
                }
            });
        </script>

    </body>
</html>
