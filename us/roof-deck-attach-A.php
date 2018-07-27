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
    $selected =  $mitigants->getRdaA()->getMitKey();
    
    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-roofwall__') {
        // Save the shutter selection to the session
        $mitigant = $mitigants->getRoofToWall();
        $rwall = isset($_POST['__chars-rwall__']) ? $_POST['__chars-rwall__'] : '';
        switch ($rwall) {
            case 'tnail':
                $mitigant->setCurval($rwall);
                $mitigant->setMitKey($rwall);
                break;
            case 'strap':
                $mitigant->setCurVal($rwall);
                $mitigant->setMitKey('straps');
                break;
            case 'clip':
                $mitigant->setCurVal('strap');
                $mitigant0>setMitKey('clips');
                break;
            case 'other':
                $mitigant->setCurVal('tnail');
                $mitigant->setMitKey('other');
                break;
            case 'unknown':
                $mitigant->setCurval('tnail');
                $mitigant->setMitKey('unknown');
                break;
            default:
                $mitigant->setCurval('tnail');
                $mitigant->setMitKey('unknown');                
        }
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/roof-deck-attach-A/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $response = saveUserImage($fileName, $location, 'RDA-A');
        } else {
            $response = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
    } elseif ($postFrom == '__us-RDA-A__') {
        if (isset($_SESSION[SESSION_NAME]['home'])) {
            $home = unserialize($_SESSION[SESSION_NAME]['home']);
        }
        $newID = saveState($mitigants, $home);
        $trigger = 'dataSaved';
    }

    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session after POST');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');
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
    <body class="bg-blue">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner">
                <div class="characteristics-wrapper container half_padding_left half_padding_right">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="rdaAForm" id="rdaAForm" action="<?php echo HOME_LINK; ?>us/roof-deck-attach-B.php">
                            <input type="hidden" name="postFrom" value="__us-RDA-A__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />

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
                                        <input type="radio" name="__chars-rdaa__" value="unknown" />
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
                $formId = 'rdaAForm';
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
                 $("#rdaAForm").attr("action", "<?php echo HOME_LINK; ?>/us/roof-wall.php");
                 $("#rdaAForm").submit(); 
            });
            $("#saveBtn").click(function() {
                 $("#rdaAForm").attr("action", "<?php echo HOME_LINK; ?>/us/roof-deck-attach-A.php");
                 $("#rdaAForm").submit(); 
            });
            
            $('img').on({
                'click': function() {
                    if ($(this).attr('id') === 'sel1') {
                        var element = document.getElementById('sel1_cb');
                        var otherElement4 = document.getElementById('sel5');
                        var otherElement5 = document.getElementById('sel6');
                        if ($(element).is(':visible')) {
                            // Deselect this
                            $(element).hide();
                        } else {
                            // Select this
                            $(element).show();
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(otherElement4).attr('src', sel5Src);
                            $(otherElement5).attr('src', sel6Src);
                        }
                        $(document.getElementById('sel2_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                        $(document.getElementById('sel5_cb')).hide();
                        $(document.getElementById('sel6_cb')).hide();
                    } else if ($(this).attr('id') === 'sel2') {
                        var element = document.getElementById('sel2_cb');
                        var otherElement4 = document.getElementById('sel5');
                        var otherElement5 = document.getElementById('sel6');
                        if ($(element).is(':visible')) {
                            // Deselect this
                            $(element).hide();
                        } else {
                            // Select this
                            $(element).show();
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(otherElement4).attr('src', sel5Src);
                            $(otherElement5).attr('src', sel6Src);
                        }
                        $(document.getElementById('sel1_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                        $(document.getElementById('sel5_cb')).hide();
                        $(document.getElementById('sel6_cb')).hide();
                    } else if ($(this).attr('id') === 'sel3') {
                        var element = document.getElementById('sel3_cb');
                        var otherElement4 = document.getElementById('sel5');
                        var otherElement5 = document.getElementById('sel6');
                        if ($(element).is(':visible')) {
                            // Deselect this
                            $(element).hide();
                        } else {
                            // Select this
                            $(element).show();
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(otherElement4).attr('src', sel5Src);
                            $(otherElement5).attr('src', sel6Src);
                        }
                        $(document.getElementById('sel1_cb')).hide();
                        $(document.getElementById('sel2_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                        $(document.getElementById('sel5_cb')).hide();
                        $(document.getElementById('sel6_cb')).hide();
                    } else if ($(this).attr('id') === 'sel4') {
                        var element = document.getElementById('sel4_cb');
                        var otherElement4 = document.getElementById('sel5');
                        var otherElement5 = document.getElementById('sel6');
                        if ($(element).is(':visible')) {
                            // Deselect this
                            $(element).hide();
                        } else {
                            // Select this
                            $(element).show();
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(otherElement4).attr('src', sel5Src);
                            $(otherElement5).attr('src', sel6Src);
                        }
                        $(document.getElementById('sel1_cb')).hide();
                        $(document.getElementById('sel2_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel5_cb')).hide();
                        $(document.getElementById('sel6_cb')).hide();
                    } else if ($(this).attr('id') === 'sel5') {
                        var src = $(this).attr('src');
                        var otherElement5 = document.getElementById('sel6');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/other-off.png') {
                            // Select this
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-on.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel5Src);
                            $(document.getElementById('sel5_cb')).show();
                            $(otherElement5).attr('src', sel6Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel6_cb')).hide();
                        } else {
                            // Deselect this
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            $(this).attr('src', sel5Src);
                            $(document.getElementById('sel5_cb')).hide();
                        }                    
                    } else if ($(this).attr('id') === 'sel6') {
                        var src = $(this).attr('src');
                        var otherElement5 = document.getElementById('sel5');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png') {
                            // Select this
                            sel5Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel6Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-on.png';
                            $(this).attr('src',sel6Src);
                            $(document.getElementById('sel6_cb')).show();
                            $(otherElement5).attr('src', sel5Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                            $(document.getElementById('sel5_cb')).hide();
                        } else {
                            // Deselect this
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
