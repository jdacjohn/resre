<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');

    $mitigants = new resre\ResReMitigators;
    $home = new resre\ResReHome();
    
    // Get modal triggers and upload responses (if any) and clear them from the session for subsequent pages
    $response = isset($_SESSION[SESSION_NAME]['response']) ? $_SESSION[SESSION_NAME]['response'] : 0;
    // Now wipe the page so we don't show erroneous messages on subsequent pages
    unset($_SESSION[SESSION_NAME]['response']);
    $trigger = isset($_SESSION[SESSION_NAME]['trigger']) ? $_SESSION[SESSION_NAME]['trigger'] : '';
    // Now wipe the trigger so we don't hose subsequent pages
    unset($_SESSION[SESSION_NAME]['trigger']);
    
    // Get the mitgation set from the session if already created.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    } 
    $selected = $mitigants->getStories()->getCurVal();
    // Get the home object from the session if already created.
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    } 
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
        <link href="<?php echo $root; ?>css/chars-sel.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/stories.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body class="bg-blue">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics container">
            <div class="characteristics-inner" id="charSelectPanel">
                <div class="characteristics-wrapper container">
                    <div class="wt-content-wrapper left">
                        <form method="post" name="storiesForm" id="storiesForm" action="<?php echo HOME_LINK . '_includes/procCrit/procUSStories.php'?>" >
                            <input type="hidden" name="postFrom"  id="postFrom" value="__us-stories__" />
                            <input type="hidden" name="postBack" id="postBack" value="<?php echo $selected; ?>" />
                            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />
                            <div class="row">
                                <div class="hidden-xs col-sm-12 chars-header-text white3040" id="getStarted">
                                    Creating your own personalized inspection report and damage simulation is easy.  Scroll down to start!
                                </div>                                
                            </div>
                            <div class="row" id="step1">  <!-- Marker Number and Page Heading -->
                                <div class="col-xs-2 chars-marker chars"><span class="blue2532Bold marker-white">1</span></div>
                                <div class="col-xs-10 col-sm-8 topic"><h4 class="chars-h4">Stories</h4></div>
                            </div>
                            <div class="row">  <!-- Page Description -->
                                <div class="col-xs-2 chars-marker chars"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                                <div class="col-xs-10 col-md-8 chars-desc white2025">
                                    A one-story home has only one level defined as the ground floor. A one-story home with a loft of any area with a living space 
                                    between the ceiling of the ground floor and the roof is considered two stories.
                                </div>
                            </div>
                            <div class="row no-padding-top no-padding-bottom">  <!-- Selection Buttons -->
                                <!-- RADIOS -->
                                <div class="col-xs-2">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-stories__" value="F1" />
                                        <img id="sel1" src="<?php echo SITE_ROOT; ?>/us/images/one-story-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            One story house
                                        </p>
                                    </label>
                                    <div id="sel1_cb" class="chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                                <div class="col-xs-2 hidden-sm hidden-md hidden-lg">&nbsp;</div>
                                <div class="col-xs-10 col-sm-3 chars-header">
                                    <label class="select-button">
                                        <input type="radio" name="__chars-stories__" value="F2" />
                                        <img id="sel2" src="<?php echo SITE_ROOT; ?>/us/images/two-story-off.png" class="img-responsive chars-select">
                                        <p class="chars-label chars-buffer white2025Bold">
                                            Two or more stories
                                        </p>
                                    </label>
                                    <div id="sel2_cb" class="chars-checkbox fix-left" style="display: none"><img src="<?php echo SITE_ROOT; ?>/us/images/checkmark_blue-dark.png" class="img-responsive check-select"/></div>
                                </div>
                                <div class="clear hidden-xs"></div>
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
        <!-- Image Preloads -->
        <div id="preload">
            <img src="<?php echo SITE_ROOT; ?>/us/images/one-story-on.png" height="1" alt="One-Story Home" />
            <img src="<?php echo SITE_ROOT; ?>/us/images/two-story-on.png" height="1" alt="Two-Story Home" />
        </div>
        <!-- Modals -->
        <?php
            $action = SITE_ROOT . '/_includes/procCrit/procUSStories.php';
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
                 $(document.getElementById('postFrom')).val('__us-stories-back__');
                 $("#storiesForm").submit(); 
            });
            $("#saveBtn").click(function() {
                $(document.getElementById('postFrom')).val('__us-stories-save__');
                $("#storiesForm").submit();
            });

        </script>
        
    </body>
</html>
