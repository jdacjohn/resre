<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');

    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    $mitigants = new resre\ResReMitigators();
    $home = new resre\ResReHome();
    $trigger = '';
    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    }
    // Get the home object from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    }

    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    $heading = 'Your Report is Complete';
    // Set the session vars based on the _POST values
    if ($postFrom == '__us-WB__') {
        $mitigant = $mitigants->getWaterBarrier();
        // Save the shutter selection to the session
        $waterBarrier = isset($_POST['__chars-wb__']) ? $_POST['__chars-wb__'] : '';
        switch ($waterBarrier) {
            case 'swryscc':
                $mitigant->setCurVal('swrys');
                $mitigant->setMitKey($waterBarrier);
                break;
            case 'swryssa':
                $mitigant->setCurVal('swrys');
                $mitigant->setMitKey($waterBarrier);
                break;
            case 'swrno':
                $mitigant->setCurVal($waterBarrier);
                $mitigant->setMitKey($waterBarrier);
                break;
        }
        // Write the changes back to the session.
        $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    }


    // Build the base config and currentHomeCharString from the session data.
    $baseConfig = $mitigants->getBaseConfig();
    $currentHomeCharString = $mitigants->getCurHomeCharString();
    $retrofitCharString = $mitigants->getOptimalHomeCharString($home->getNumberOfComponents());

    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session after POST');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResRe Mitigators');
    printVarIfDebug($baseConfig, getenv('gDebug'), 'Base Home Configuration String');
    printVarIfDebug($currentHomeCharString, getenv('gDebug'), 'Current Home Characteristics String');
    printVarIfDebug($retrofitCharString, getenv('gDebug'), 'Retrofit String');

    // Get the initial Damage Assessment Results.
    $assessor = new resre\ResReDamageAssessment($baseConfig, $currentHomeCharString, $home->getNumberOfComponents(), $home->homeValue);
    printVarIfDebug($assessor, getenv('gDebug'), 'Current DamageAssessor Object');

    $assessor->buildReport();
    $dmgWithoutMitigation = $assessor->getEstimatedLoss();
    printVarIfDebug($dmgWithoutMitigation, getenv('gDebug'), 'Damage before mitigation');

    // Get Retrofit Damage Assessment Results
    $retroAssessor = new resre\ResReDamageAssessment($baseConfig, $retrofitCharString, $home->getNumberOfComponents(), $home->homeValue);
    printVarIfDebug($retroAssessor, getenv('gDebug'), 'Retro DamageAssessor Object');

    $retroAssessor->buildReport();
    $dmgAfterMitigation = $retroAssessor->getEstimatedLoss();
    printVarIfDebug($dmgAfterMitigation, getenv('gDebug'), 'Damage after mitigation');

    // Store the objects in the session
    $_SESSION[SESSION_NAME]['assessor'] = serialize($assessor);
    $_SESSION[SESSION_NAME]['retroAssessor'] = serialize($retroAssessor);

    // If we got here because of the 'Save' button' let's go ahead and save the user data to the DB
    if ($postFrom == '__us-complete__') {
        // Now, between the assessment object created above and the new home object, we can populate a full row of userdata in the new table.
        $newID = saveState($mitigants, $home);
        $heading = 'Your Report Has Been Saved';
        $trigger = 'dataSaved';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Load site meta information -->
<?php include($root . 'includes/page-head-meta.php'); ?>
        <title><?php echo PROJECT_TITLE_SHORT; ?> US Damage Assessment - Criteria Selection Complete</title>
        <!-- Load Page HEAD script files -->
<?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/complete.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body>
<?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="carousel container-fluid">
            <div id="carousel" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo $root; ?>us/images/us-complete-bg.png" class="carousel_img" alt="#" />
                        <div class="carousel-caption container half_padding_left half_padding_right">
                            <div class="carousel-content-wrapper left">
                                <div class="row">
                                    <div class="complete-border-middle-1"></div>                                
                                    <div class="complete-border-middle-2"></div>                                
                                    <div class="col-md-2 col-sm-2 col-xs-2 chars-marker complete-modal"><span class="blue2532Bold marker-complete" style="margin-bottom: 0px; ">100</span></div>
                                    <!-- <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4">Your Report is Complete</h4></div> -->
                                </div>
                            </div>
                        </div><!-- /carousel_content_wrapper -->
                    </div><!-- /item -->
                </div><!-- /carousel-inner -->
            </div><!-- /carousel -->      
        </div><!-- /carousel container -->

        <div class="row">
            <div class="chars-border-middle-wt-1"></div>                                
            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                <span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">
                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                </span>
            </div>
            <div class="col-md-8 col-sm-8 topic"><h4 class="chars-h4"><?php echo $heading; ?></h4></div>
        </div>
        <div class="row">
            <div class="chars-border-middle-wt-2 hidden-xs"></div>
            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
            <div class="col-md-8 col-sm-10 col-xs-10 chars-desc white2025">
                Click Continue to view your report, or Back to change your selections.
            </div>
        </div>
        <form method="post" name="completeForm" id="completeForm" action="<?php echo HOME_LINK; ?>us/report.php">
            <input type="hidden" name="postFrom" id="postFrom" value="__us-complete__" />
            <input type="hidden" name="trigger" id="trigger" value="<?php echo $trigger; ?>" />
        </form>
        <!-- Continue-Cancel-Save -->
        <div class="row complete">
            <div class="chars-border-middle"></div>                                
            <div class='col-xs-10 col-xs-offset-1 col-sm-6 col-md-6 ccButtons ccButton-first'>
                <a href="#" class='mid-button-mustard' onclick="document.getElementById('completeForm').submit();"><span class="blue2228Bold">Continue</span></a>
            </div>
            <div class='col-xs-5 col-xs-offset-1 col-sm-2 col-md-2 ccButtons ccButton-middle'>
                <a href="#" id="moveBack" class='mid-button-sand'><span class="blue2228Bold">Back</span></a>
            </div>
            <div class='col-xs-5 col-sm-2 col-md-2 ccButtons ccButton-last'>
                <a href="#" id="stayHere" class='mid-button-sand'><span class="blue2228Bold">Save</span></a>
            </div>
        </div>
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Modal for saving data -->
        <?php include($root . 'includes/modals/dataSave.php'); ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>

        <script>
            $(window ).on({
                'load': function() {
                    var trigger = $(document.getElementById('trigger')).attr('value');
                    console.log("trigger = " + trigger);
                    if (trigger === 'dataSaved') {
                        console.log('Session state saved to DB');
                        $("#dataSavedModal").modal('toggle');
                    }
                }
            });

            
            $("#moveBack").click(function () {
                $("#completeForm").attr("action", "<?php echo HOME_LINK; ?>us/water-barrier.php");
                $("#completeForm").submit();
            });
            $("#stayHere").click(function () {
                $("#completeForm").attr("action", "<?php echo HOME_LINK; ?>us/complete.php");
                $("#completeForm").submit();
            });
        </script>

    </body>
</html>
