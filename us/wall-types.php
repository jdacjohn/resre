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
    $selected =  $mitigants->getWallType()->getMitKey();

    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-stories__') {
        // Save the base config for number of stories.
        $mitigant = $mitigants->getStories();
        $mitigant->setCurVal(isset($_POST['__chars-stories__']) ? $_POST['__chars-stories__'] : '');
        $mitigant->setOptimumVal($mitigant->getCurVal());
        $mitigant->setMitKey(strtolower($mitigant->getCurVal()));
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/wall-types/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $response = saveUserImage($fileName, $location, 'wall-type');
        } else {
            $response = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
    } elseif ($postFrom == '__us-walltypes__') {
        if (isset($_SESSION[SESSION_NAME]['home'])) {
            $home = unserialize($_SESSION[SESSION_NAME]['home']);
     }
        $newID = saveState($mitigants, $home);
        $trigger = 'dataSaved';
    }
      
    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session After Posting');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');
    
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
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/wt.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body class="bg-blue">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner">
                <div class="characteristics-wrapper container half_padding_left half_padding_right">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="wtForm" id='wtForm' action="<?php echo HOME_LINK; ?>us/shutters.php">
                            <input type="hidden" name="postFrom" value="__us-walltypes__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />

                            <div class="row">
                                <div class="chars-border-middle-wt-1"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">2</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Wall Types</h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    A trick to determining your wall type is to look at the windows from the outside of the home. Frame windows are typically
                                    mounted flush with the wall and with masonry walls the windows are typically inset.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <div class="chars-border-middle-wt-4"></div>
                                <div class="chars-border-middle-wt-4a"></div>
                                <!-- RADIOS -->
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-walltype__" value="WS" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/frame-walls-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Frame
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-walltype__" value="rmfys" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Reinforced Masonry
                                    </div>
                                </div>
                                <div class="clear hidden-xs"></div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-walltype__" value="rmfno" />
                                        <img id="sel3" src="<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel3_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Non-Reinforced Masonry
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-walltype__" value="unknown" />
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
                $formId = 'wtForm';
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
                    if (selection === 'ws') {
                        console.log('Wood Frame');
                        $(document.getElementById('sel1')).click();
                    }
                    if (selection === 'rmfys') {
                        console.log('Masonry');
                        $(document.getElementById('sel2')).click();
                    }
                    if (selection === 'rmfno') {
                        console.log('Other');
                        $(document.getElementById('sel3')).click();
                    }
                    if (selection === 'unknown') {
                        console.log('Unknown');
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

            $('img').on({
                'click': function() {
                    var sel1ImageSrc;
                    var sel2ImageSrc;
                    var sel3ImageSrc;
                    var sel4ImageSrc;
                    if ($(this).attr('id') === 'sel2') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel3');
                        var otherElement3 = document.getElementById('sel4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png') {
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-on.png';
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/frame-walls-off.png';
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png';
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel2ImageSrc);
                            $(otherElement1).attr('src',sel1ImageSrc);
                            $(otherElement2).attr('src',sel3ImageSrc);
                            $(otherElement3).attr('src',sel4ImageSrc);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).show();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                        } else {
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png';
                            $(this).attr('src', sel2ImageSrc);
                            $(document.getElementById('sel2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel1') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel2');
                        var otherElement2 = document.getElementById('sel3');
                        var otherElement3 = document.getElementById('sel4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/frame-walls-off.png') {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/frame-walls-on.png';
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png';
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png';
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel1ImageSrc);
                            $(otherElement1).attr('src',sel2ImageSrc);
                            $(otherElement2).attr('src',sel3ImageSrc);
                            $(otherElement3).attr('src',sel4ImageSrc);
                            $(document.getElementById('sel1_cb')).show();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).hide();
                        } else {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/frame-walls-off.png';
                            $(this).attr('src', sel1ImageSrc);
                            $(document.getElementById('sel1_cb')).hide();
                        } 
                    } else if ($(this).attr('id') === 'sel3') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel4');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png') {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/frame-walls-off.png';
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png';
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-on.png';
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src',sel3ImageSrc);
                            $(otherElement1).attr('src',sel1ImageSrc);
                            $(otherElement2).attr('src',sel2ImageSrc);
                            $(otherElement3).attr('src',sel4ImageSrc);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).show();
                            $(document.getElementById('sel4_cb')).hide();
                        } else {
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png';
                            $(this).attr('src', sel3ImageSrc);
                            $(document.getElementById('sel3_cb')).hide();
                        }
                } else if ($(this).attr('id') === 'sel4') {
                        var src = $(this).attr('src');
                        var otherElement1 = document.getElementById('sel1');
                        var otherElement2 = document.getElementById('sel2');
                        var otherElement3 = document.getElementById('sel3');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png') {
                            sel1ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/frame-walls-off.png';
                            sel2ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png';
                            sel3ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/masonry-walls-off.png';
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-on.png';
                            $(this).attr('src',sel4ImageSrc);
                            $(otherElement1).attr('src',sel1ImageSrc);
                            $(otherElement2).attr('src',sel2ImageSrc);
                            $(otherElement3).attr('src',sel3ImageSrc);
                            $(document.getElementById('sel1_cb')).hide();
                            $(document.getElementById('sel2_cb')).hide();
                            $(document.getElementById('sel3_cb')).hide();
                            $(document.getElementById('sel4_cb')).show();
                        } else {
                            sel4ImageSrc = '<?php echo SITE_ROOT; ?>/us/images/unknown-off.png';
                            $(this).attr('src', sel4ImageSrc);
                            $(document.getElementById('sel4_cb')).hide();
                        }
                    }
                }
            });
            
            $("#moveBack").click(function() {
                 $("#wtForm").attr("action", "<?php echo HOME_LINK; ?>us/stories.php");
                 $("#wtForm").submit(); 
            });
            $("#saveBtn").click(function() {
                $("#wtForm").attr("action", "<?php echo HOME_LINK; ?>us/wall-types.php");
                $("#wtForm").submit();
            });

        </script>
        
    </body>
</html>
