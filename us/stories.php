<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');

    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    $mitigants = new resre\ResReMitigators;
    $home = new resre\ResReHome();
    $response = 0;
    $trigger = '';
    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    } 
    $selected = $mitigants->getStories()->getCurVal();
    // Get the home object from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    } 
    
    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-loc__') {
        // Posted from the location page.  Save the location post data to the home object.
        $home->geoLoc = filter_input(INPUT_POST, 'input_geoLoc', FILTER_SANITIZE_STRING);
        $home->latLng = $_POST['geo-home-location'];
        $home->zipCode = $_POST['geo-home-postal_code'];
        $home->locality = $_POST['geo-home-locality'];
        $home->state = $_POST['geo-home-state'];
        $home->country = $_POST['geo-home-country_short'];
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/stories/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $response = saveUserImage($fileName, $location, 'stories');
        } else {
            $response = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
    } elseif ($postFrom == '__us-stories__') {
        // User clicked the save button.
        $rowID = saveState($mitigants, $home);
        $trigger = 'dataSaved';
    }
      
    // Save the home and mitigator objects to the session
    $_SESSION[SESSION_NAME]['home'] = serialize($home);
    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session After Posting');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($home, getenv('gDebug'), 'ResReHome');
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
        <link href="<?php echo $root; ?>css/stories.css" rel='stylesheet' type='text/css' media="all" />
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
                        <form method="post" name="storiesForm" id="storiesForm" action="<?php echo HOME_LINK; ?>us/wall-types.php">
                            <input type="hidden" name="postFrom"  value="__us-stories__" />
                            <intput type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />
                            <div class="row">
                                <div class="chars-border-middle-wt-1"></div>                                
                                <div class="lineStopTop hidden-xs"></div>
                                <div class="lineStopBot hidden-xs"></div>
                                <div class="col-md-12 col-xs-12 hidden-xs chars-header-text white3040">
                                    Creating your own personalized inspection report and damage simulation is easy.  Scroll down to start!
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Stories</h4></div>
                            </div>
                            <div class="row">
                                <div class="chars-border-middle-wt-2"></div>
                                <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                                    A one-story home has only one level defined as the ground floor. A one-story home with a loft of any area with a living space 
                                    between the ceiling of the ground floor and the roof is considered two stories.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">
                                <div class="chars-border-middle-wt-3"></div>
                                <!-- RADIOS -->
                                <!-- <div class="col-md-2 col-sm-2 hidden-xs chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div> -->
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header chars-bumper">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-stories__" value="F1" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/one-story-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel1_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        One story house
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-10 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-stories__" value="F2" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/two-story-off.png" class="img-responsive chars-select">
                                    </label>
                                    <div id="sel2_cb" class="col-xs-6 chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                    <div class="chars-header chars-label chars-buffer white2025Bold">
                                        Two or more stories
                                    </div>
                                </div>
                                <div class="clear hidden-xs"></div>
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
                $formId = 'storiesForm';
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
                    if (selection === 'F1') {
                        console.log('Single Story');
                        $(document.getElementById('sel1')).click();
                    }
                    if (selection === 'F2') {
                        console.log('Two or More Stories');
                        $(document.getElementById('sel2')).click();
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
                    var twoImageSrc;
                    var singleImageSrc;
                    if ($(this).attr('id') === 'sel2') {
                        var src = $(this).attr('src');
                        var otherElement = document.getElementById('sel1');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/two-story-off.png') {
                            twoImageSrc = '<?php echo SITE_ROOT; ?>/us/images/two-story-on.png';
                            $(document.getElementById('sel2_cb')).show();
                            singleImageSrc = '<?php echo SITE_ROOT; ?>/us/images/one-story-off.png';
                            $(this).attr('src',twoImageSrc);
                            $(otherElement).attr('src',singleImageSrc);
                            $(document.getElementById('sel1_cb')).hide();
                        } else {
                            twoImageSrc = '<?php echo SITE_ROOT; ?>/us/images/two-story-off.png';
                            $(this).attr('src', twoImageSrc);
                            $(document.getElementById('sel2_cb')).hide();
                        }
                    } else if ($(this).attr('id') === 'sel1') {
                        var src = $(this).attr('src');
                        var otherElement = document.getElementById('sel2');
                        if (src === '<?php echo SITE_ROOT; ?>/us/images/one-story-off.png') {
                            twoImageSrc = '<?php echo SITE_ROOT; ?>/us/images/two-story-off.png';
                            singleImageSrc = '<?php echo SITE_ROOT; ?>/us/images/one-story-on.png';
                            $(this).attr('src',singleImageSrc);
                            $(document.getElementById('sel1_cb')).show();
                            $(otherElement).attr('src', twoImageSrc);
                            $(document.getElementById('sel2_cb')).hide();
                        } else {
                            singleImageSrc = '<?php echo SITE_ROOT; ?>/us/images/one-story-off.png';
                            $(this).attr('src', singleImageSrc);
                            $(document.getElementById('sel1_cb')).hide();
                        }
                    }
                }
            });

            $("#moveBack").click(function() {
                 $("#storiesForm").attr("action", "<?php echo HOME_LINK; ?>us/loc.php");
                 $("#storiesForm").submit(); 
            });
            $("#saveBtn").click(function() {
                $("#storiesForm").attr("action", "<?php echo HOME_LINK; ?>us/stories.php");
                $("#storiesForm").submit();
            });

        </script>
        
    </body>
</html>
