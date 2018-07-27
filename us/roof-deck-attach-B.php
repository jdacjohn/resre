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
    $selected =  $mitigants->getRdaB()->getMitKey();

    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-RDA-A__') {
        // Save the shutter selection to the session
        $mitigant = $mitigants->getRdaA();
        $rdaa = isset($_POST['__chars-rdaa__']) ? $_POST['__chars-rdaa__'] : '';
        switch ($rdaa) {
            case 'rda6d':
                $mitigant->setCurVal('rda6');
                $mitigant->setMitKey('rda6d');
                break;
            case 'rda8d':
                $mitigant->setCurVal('rda8');
                $mitigant->setMitKey('rda8s');
                break;
            case 'rda10d':
                $mitigant->setCurVal('rda8');
                $mitigant->setMitKey('rda10d');
                break;
            case 'rda6s':
                $mitigant->setCurVal('rda6');
                $mitigant->setMitKey('rda6s');
                break;
            case 'other':
                $mitigant->setCurVal('rda6');
                $mitigant->setMitKey('other');
                break;
            case 'unknown':
                $mitigant->setCurVal('rda6');
                $mitigant->setMitKey('unknown');
                break;
        }
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/roof-deck-attach-B/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $response = saveUserImage($fileName, $location, 'RDA-B');
        } else {
            $response = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
    } elseif ($postFrom == '__us-RDA-B__') {
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
                        <form method="post" name="rdaBForm" id="rdaBForm" action="<?php echo HOME_LINK; ?>us/water-barrier.php">
                            <input type="hidden" name="postFrom" value="__us-RDA-B__" />
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
                 $("#rdaBForm").attr("action", "<?php echo HOME_LINK; ?>/us/roof-deck-attach-A.php");
                 $("#rdaBForm").submit(); 
            });
            $("#saveBtn").click(function() {
                 $("#rdaBForm").attr("action", "<?php echo HOME_LINK; ?>/us/roof-deck-attach-B.php");
                 $("#rdaBForm").submit(); 
            });
            
            $('img').on({
                'click': function() {
                    if ($(this).attr('id') === 'sel1') {
                        var element = document.getElementById('sel1_cb');
                        var otherElement2 = document.getElementById('sel3');
                        var otherElement3 = document.getElementById('sel4');
                        if ($(element).is(':visible')) {
                            // Deselect this
                            $(element).hide();
                        } else {
                            // Select this
                            $(element).show();
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(otherElement2).attr('src', sel3Src);
                            $(otherElement3).attr('src', sel4Src);
                        }
                        $(document.getElementById('sel2_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                    } else if ($(this).attr('id') === 'sel2') {
                        var element = document.getElementById('sel2_cb');
                        var otherElement2 = document.getElementById('sel3');
                        var otherElement3 = document.getElementById('sel4');
                        if ($(element).is(':visible')) {
                            // Deselect this
                            $(element).hide();
                        } else {
                            // Select this
                            $(element).show();
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(otherElement2).attr('src', sel3Src);
                            $(otherElement3).attr('src', sel4Src);
                        }
                        $(document.getElementById('sel1_cb')).hide();
                        $(document.getElementById('sel3_cb')).hide();
                        $(document.getElementById('sel4_cb')).hide();
                    } else if ($(this).attr('id') === 'sel3') {
                        var src = $(this).attr('src');
                        var otherElement3 = document.getElementById('sel4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/other-off.png') {
                            // Select this
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-on.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel3Src);
                            $(document.getElementById('sel3_cb')).show();
                            $(otherElement3).attr('src', sel4Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                        } else {
                            // Deselect this
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            $(this).attr('src', sel3Src);
                            $(document.getElementById('sel3_cb')).hide();
                        }                    
                    } else if ($(this).attr('id') === 'sel4') {
                        var src = $(this).attr('src');
                        var otherElement3 = document.getElementById('sel3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png') {
                            // Select this
                            sel3Src = '<?php echo SITE_ROOT; ?>/us/images/other-off.png';
                            sel4Src = '<?php echo SITE_ROOT; ?>/us/images/unknown-on.png';
                            $(this).attr('src',sel4Src);
                            $(document.getElementById('sel4_cb')).show();
                            $(otherElement3).attr('src', sel3Src);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                        } else {
                            // Deselect this
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
