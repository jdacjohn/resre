<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');
    if (!isset($_SESSION[SESSION_NAME]['home'])) {
        // Session has expired or user not logged in
        header('Location:  ' . HOME_LINK . 'us/index.php?postFrom=login');
    }
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session on Entry');
    $resReHome = unserialize($_SESSION[SESSION_NAME]['home']);
    $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    if (isset($_SESSION[SESSION_NAME]['assessor'])) {
        $assessor = unserialize($_SESSION[SESSION_NAME]['assessor']);
    } else {
        $assessor = new resre\ResReDamageAssessment($mitigants->getBaseConfig(), $mitigants->getCurHomeCharString(), $resReHome->getNumberOfComponents(), $resReHome->homeValue);
        $assessor->buildReport();
        $_SESSION[SESSION_NAME]['assessor'] = serialize($assessor);
    }
    if (isset($_SESSION[SESSION_NAME]['retroAssessor'])) {
        $retroAssessor = unserialize($_SESSION[SESSION_NAME]['retroAssessor']);
    } else {
        $retroAssessor = new resre\ResReDamageAssessment($mitigants->getBaseConfig(), $mitigants->getOptimalHomeCharString(), 7, $resReHome->homeValue);
        $retroAssessor->buildReport();
        $_SESSION[SESSION_NAME]['retroAssessor'] = serialize($retroAssessor);
    }

    $gDoorYN = $mitigants->getGarageDoor()->getCurVal();
    $numComponents = ($gDoorYN == 'gndod' || $gDoorYN == 'gdno2') ? 8 : 9;
    
    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    if ($postFrom == '__us-report__') {
        $assessor->setHurricaneCategory($_POST['hCat']);
        $assessor->buildReport();
        $retroAssessor->setHurricaneCategory($_POST['hCat']);
        $retroAssessor->buildReport();
        $_SESSION[SESSION_NAME]['assessor'] = serialize($assessor);
        $_SESSION[SESSION_NAME]['retroAssessor'] = serialize($retroAssessor);
    }
    $category = $assessor->getHurricaneCategory();
    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");
    printVarIfDebug($assessor, getenv('gDebug'), "ResRe Current Assessment Object unserialized from Session");
    printVarIfDebug($retroAssessor, getenv('gDebug'), "ResRe Optimal Assessment Object unserialized from Session");
    printVarIfDebug($resReHome, getenv('gDebug'), "ResRe Home object unserialized from Session");
    printVarIfDebug($mitigants, getenv('gDebug'), "Damage Mitigators");
    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Load site meta information -->
        <?php include($root . 'includes/page-head-meta.php'); ?>
        <title><?php echo PROJECT_TITLE_SHORT; ?> Resilient Residence Report</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/report.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body class="slate">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics rpt-wrapper">
            <div class="characteristics-inner" id="ci">
                <div class="characteristics-wrapper">
                   <div class="wt-content-wrapper left" id="reportWrapper"> 
                        <!-- Report Heading -->
                        <div class="row report-header" id="reportHeader">
                            <div class="chars-border-middle-wt-1" id="cbmwt1"></div>
                            <div class="chars-border-middle-wt-2" id="cbmwt2"></div>
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars" id="topCharMarker">
                                <span class="blue2532Bold marker-white" style="margin-bottom: 0px; " id="topCharMarkerCircle">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <div class="col-md-10 col-xs-10 white2025Black report-title">
                                Resilient Residence Report
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10 col-xs-offset-2 topic"><h4 class="chars-h4"><?php echo $resReHome->homeOwnerFirstName; ?>'s <?php echo $resReHome->homeName; ?></h4></div>
                        </div>
                        <div class="row report-header section-padding" id="reportHeaderContent">
                            <div class="col-md-10 col-sm-10 col-xs-10 col-xs-offset-2 chars-desc white2025">
                                The purpose of this report is to identify specific actions that you can take to strengthen your home against
                                hurricanes.  Please use this report as a resource to make your home as hurricane-resistant as possible.  
                                Contact a licensed, bonded, and insured contractor to plan your repairs and to ensure your home is ready 
                                for high winds.
                            </div>
                            <div class='clear'></div>
                        </div>
                        <!-- Report Summary -->
                        <div class='row report-summary' id="reportSummary">
                            <div class='chars-border-middle-wt-3' id="cbmwt3"></div>
                            <div class='mit-cost white2230 hidden-xs hidden-sm'>
                                <h4>Mitigation Cost Analysis</h4>
                                <h4>Free - $</h4>
                                Less than $500
                                <h4>$$</h4>
                                $501 - $1000
                                <h4>$$$</h4>
                                $1001 - $5000
                                <h4>$$$$</h4>
                                $5001+
                            </div>
                            <div class='mit-cost-small white2025 hidden-md hidden-lg' id="mitCostSmall">
                                <p><span class="white2025Black">Mitigation Cost Analysis</span></p>
                                <table style="text-align: left;">
                                    <tr>
                                        <th width="60%" style="text-align: left;">Free - $</th>
                                        <th width="40%" style="text-align: left;">$</th>
                                    </tr>
                                    <tr>
                                        <td>Less than $500</td>
                                        <td>$501 - $1000</td>
                                    </tr>
                                    <tr>
                                        <th width="45%" style="text-align: left;">&nbsp;</th>
                                        <th width="45%" style="text-align: left;">&nbsp;</th>
                                    </tr>
                                    <tr>
                                        <th width="45%" style="text-align: left;">$$$</th>
                                        <th width="45%" style="text-align: left;">$$$$</th>
                                    </tr>
                                    <tr>
                                        <td>$1001 - $5000</td>
                                        <td>$5001+</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars" id="midCharMarker">
                                <span class="blue2532Bold marker-white" style="margin-bottom: 0px; " id="midCharMarkerCircle">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10 summary-header"><h4 class="chars-h4">Hurricane Category</h4></div>
                            <div class='clear'></div>
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker"><span class="transparent2532 marker-transparent" style="margin-bottom: 0px; ">1</span></div>
                            <div class="col-md-10 col-sm-10 col-xs-9 col-xs-offset-2 summary-desc white2025">
                                Choose a hurricane category to estimate damage before and after retrofits.
                            </div>
                            <div class='clear'></div>
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker chars-bumper"><a href="#" id="cat1" title="Average Wind Speed 85mph"><span class="blue2532Bold <?php echo ($category == 1) ? 'marker-mustard' : 'marker-white'; ?> rating" style="margin-bottom: 0px; ">1</span></a></div>
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker"><a href="#" id="cat2" title="Average Wind Speed 100mph"><span class="blue2532Bold <?php echo ($category == 2) ? 'marker-mustard' : 'marker-white'; ?> rating" style="margin-bottom: 0px; ">2</span></a></div>
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker"><a href="#" id="cat3" title="Average Wind Speed 120mph"><span class="blue2532Bold <?php echo ($category == 3) ? 'marker-mustard' : 'marker-white'; ?> rating" style="margin-bottom: 0px; ">3</span></a></div>
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker"><a href="#" id="cat4" title="Average Wind Speed 145mph"><span class="blue2532Bold <?php echo ($category == 4) ? 'marker-mustard' : 'marker-white'; ?> rating" style="margin-bottom: 0px; ">4</span></a></div>
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker"><a href="#" id="cat5" title="Average Wind Speed 165mph"><span class="blue2532Bold <?php echo ($category == 5) ? 'marker-mustard' : 'marker-white'; ?> rating" style="margin-bottom: 0px; ">5</span></a></div>
                            <div class='clear'></div>
                            <?php
                            $impactPct = number_format(($assessor->getEstimatedLoss() / $resReHome->homeValue) * 100, 2);
                            if ($assessor->getEstimatedLoss() == 0) {
                                $disclaimer = "* No loss ratio information could be found based on the home characterisitcs you selected.  Please click <a href='" . SITE_ROOT . "/us/stories.php' style='color: #ffffff; text-decoration: underline;'>HERE</a> to re-check your selections.";
                            } else {
                                $disclaimer = "* Loss percentages and values are approximate based on US Storm Loss Ratio Data and your home characteristics selections.";
                            }
                            ?>
                            <div class="col-md-8 col-sm-10 col-xs-10 risk white2025">
                                Your cost impact risk of a Category <?php echo $category; ?> hurricane is <strong><?php echo $impactPct; ?>%</strong> of your home's value before retrofits.
                                <p class="white1822">&nbsp;<br /><?php echo $disclaimer; ?></p>
                            </div>
                            <div class="col-md-8 col-sm-10 col-xs-10 risk report-title white2532Bold">
                                Damage & Calculator Cost Analysis
                            </div>
                            <div class="col-md-8 col-sm-10 col-xs-10 chars-bumper">
                                <img src="<?php echo SITE_ROOT; ?>/us/images/spectrum.png"  id='slider' class="img-responsive report-slider"/>
                            </div>
                            <div class='clear'></div>
                            <div class='col-md-1 col-md-offset-3 col-xs-4 col-xs-offset-2 white2532Bold' style='text-align: center;'>$<?php echo number_format($retroAssessor->getEstimatedLoss(), 0); ?></div>
                            <div class='col-md-1 col-md-offset-1 col-xs-4 white2532Bold'>$<?php echo number_format($assessor->getEstimatedLoss(), 0); ?></div>
                            <div class='clear'></div>
                            <div class='col-md-1 col-md-offset-3 col-xs-4 col-xs-offset-2 white1822' style="text-align: center;">After</div>
                            <div class='col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-2 col-xs-4 white1822'>Before</div>
                            <div class='clear'></div>
                        </div> <!-- End summary row -->
                        <form method="post" name="reportForm" id="reportForm" action="<?php echo HOME_LINK; ?>us/report.php">
                            <input type="hidden" name="postFrom" id="postFrom" value="__us-report__" />
                            <input type="hidden" name="hCat" id="hCat" value="<?php echo $category; ?>" />
                            <input type="hidden" name="noComp" id="noComp" value="<?php echo $numComponents; ?>" />
                        </form>
                        <!-- Retrofit Suggestions -->
                        <div class='row report-details' id="reportDetails">
                            <div class='chars-border-middle-wt-4' id="cbmwt4"></div>
                            <div class='retrofits-header white3040' id="suggestedRetrofits">Suggested Retrofits</div>
                            
                            <!-- Stories -->
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <?php $mitigant = $mitigants->getStories(); ?>
                            <div class='col-md-1 col-sm-2 col-xs-2 retrofits-icon'><img src="<?php echo SITE_ROOT; ?>/us/images/report-icons/stories.png" class="img-responsive retrofits-img" /></div>
                            <div class="col-md-3 col-sm-8 col-xs-8 retrofits-title"><h6>Stories</h6></div>
                            <div class="col-md-6 hidden-xs hidden-sm retro-hr"><hr></div>
                            <div class="clear"></div>
                            <div class="col-md-5  col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 white2230Black recommendations chars-desc">
                                FLASH Recommendations
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc">
                                <strong><?php echo $mitigant->getLabel(); ?></strong><br />
                                <?php 
                                    echo '<p>' . $mitigant->getRecommendation() , '</p>';
                                    if ($mitigant->getCostMsg() != '') {
                                        echo "<p>" . $mitigant->getCostMsg() . "</p>";
                                    }
                                ?>
                            </div>
                            <div class="col-xs-10 col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-md-offset-0 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                <strong><?php echo $mitigant->getCostIndicator(); ?></strong>
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                <?php echo ($mitigant->getResources() != '') ? '<a href="' . $mitigant->getResources() . '" target="_blank">' . $mitigant->getResFriendlyName() . '</a>' : 'No resources available'; ?>
                            </div>
                            <div class='clear'></div>
                            
                            <!-- Wall Types -->
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <?php $mitigant = $mitigants->getWallType(); ?>
                            <div class='col-md-1 col-sm-2 col-xs-2 retrofits-icon'><img src="<?php echo SITE_ROOT; ?>/us/images/report-icons/wall-types.png" class="img-responsive retrofits-img" /></div>
                            <div class="col-md-3 col-sm-8 col-xs-8 retrofits-title"><h6>Wall Types</h6></div>
                            <div class="col-md-6 hidden-xs hidden-sm retro-hr"><hr></div>
                            <div class="clear"></div>
                            <div class="col-md-5  col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 white2230Black recommendations chars-desc">
                                FLASH Recommendations
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc">
                                <strong><?php echo $mitigant->getLabel(); ?></strong><br />
                                <?php 
                                    echo '<p>' . $mitigant->getRecommendation() , '</p>';
                                    if ($mitigant->getCostMsg() != '') {
                                        echo "<p>" . $mitigant->getCostMsg() . "</p>";
                                    }
                                ?>
                            </div>
                            <div class="col-xs-10 col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-md-offset-0 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                <strong><?php echo $mitigant->getCostIndicator(); ?></strong>
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                <?php echo ($mitigant->getResources() != '') ? '<a href="' . $mitigant->getResources() . '" target="_blank">' . $mitigant->getResFriendlyName() . '</a>' : 'No resources available'; ?>
                            </div>
                            <div class='clear'></div>
                            
                            <!-- Shutters -->
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <?php $mitigant = $mitigants->getShutters(); ?>
                            <div class='col-md-1 col-xs-2 retrofits-icon'><img src="<?php echo SITE_ROOT; ?>/us/images/report-icons/shutters.png" class="img-responsive retrofits-img" /></div>
                            <div class="col-md-3 col-sm-8 col-xs-8 retrofits-title"><h6>Shutters</h6></div>
                            <div class="col-md-6 hidden-xs hidden-sm retro-hr"><hr></div>
                            <div class="clear"></div>
                            <div class="col-md-5  col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 white2230Black recommendations chars-desc">
                                FLASH Recommendations
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc">
                                <strong><?php echo $mitigant->getLabel(); ?></strong><br />
                                <?php 
                                    echo '<p>' . $mitigant->getRecommendation() , '</p>';
                                    if ($mitigant->getCostMsg() != '') {
                                        echo "<p>" . $mitigant->getCostMsg() . "</p>";
                                    }
                                ?>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                <strong><?php echo $mitigant->getCostIndicator(); ?></strong>
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                <?php echo ($mitigant->getResources() != '') ? '<a href="' . $mitigant->getResources() . '" target="_blank">' . $mitigant->getResFriendlyName() . '</a>' : 'No resources available'; ?>
                            </div>
                            <div class="clear"></div>
                            
                            <!-- Roof Shape -->
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <?php $mitigant = $mitigants->getRoofShape(); ?>
                            <div class='col-md-1 col-xs-2 retrofits-icon'><img src="<?php echo SITE_ROOT; ?>/us/images/report-icons/roof-shapes.png" class="img-responsive retrofits-img" /></div>
                            <div class="col-md-3 col-sm-8 col-xs-8 retrofits-title"><h6>Roof Shapes</h6></div>
                            <div class="col-md-6 hidden-xs hidden-sm retro-hr"><hr></div>
                            <div class="clear"></div>
                            <div class="col-md-5  col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 white2230Black recommendations chars-desc">
                                FLASH Recommendations
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc">
                                <strong><?php echo $mitigant->getLabel(); ?></strong><br />
                                <?php 
                                    echo '<p>' . $mitigant->getRecommendation() , '</p>';
                                    if ($mitigant->getCostMsg() != '') {
                                        echo "<p>" . $mitigant->getCostMsg() . "</p>";
                                    }
                                ?>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                <strong><?php echo $mitigant->getCostIndicator(); ?></strong>
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                <?php echo ($mitigant->getResources() != '') ? '<a href="' . $mitigant->getResources() . '" target="_blank">' . $mitigant->getResFriendlyName() . '</a>' : 'No resources available'; ?>
                            </div>
                            <div class="clear"></div>
                            
                            <!-- Garage -->
                            <?php $mitigant = $mitigants->getGarageDoor(); ?>
                            <?php if ($mitigant->getMitKey() != '') { ?>
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <div class='col-md-1 col-xs-2 retrofits-icon'><img src="<?php echo SITE_ROOT; ?>/us/images/report-icons/garage.png" class="img-responsive retrofits-img" /></div>
                            <div class="col-md-3 col-sm-8 col-xs-8 retrofits-title"><h6>Garage Door</h6></div>
                            <div class="col-md-6 hidden-xs hidden-sm retro-hr"><hr></div>
                            <div class="clear"></div>
                            <div class="col-md-5  col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 white2230Black recommendations chars-desc">
                                FLASH Recommendations
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc">
                                <strong><?php echo $mitigant->getLabel(); ?></strong><br />
                                <?php 
                                    echo '<p>' . $mitigant->getRecommendation() , '</p>';
                                    if ($mitigant->getCostMsg() != '') {
                                        echo "<p>" . $mitigant->getCostMsg() . "</p>";
                                    }
                                ?>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                <strong><?php echo $mitigant->getCostIndicator(); ?></strong>
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                <?php echo ($mitigant->getResources() != '') ? '<a href="' . $mitigant->getResources() . '" target="_blank">' . $mitigant->getResFriendlyName() . '</a>' : 'No resources available'; ?>
                            </div>
                            <div class="clear"></div>
                            <?php } ?>
                            
                            <!-- Root to Wall -->
                            <?php $mitigant = $mitigants->getRoofToWall(); ?>
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <div class='col-md-1 col-xs-2 retrofits-icon'><img src="<?php echo SITE_ROOT; ?>/us/images/report-icons/roof-wall.png" class="img-responsive retrofits-img" /></div>
                            <div class="col-md-3 col-sm-8 col-xs-8 retrofits-title"><h6>Roof to Wall</h6></div>
                            <div class="col-md-6 hidden-xs hidden-sm retro-hr"><hr></div>
                            <div class="clear"></div>
                            <div class="col-md-5  col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 white2230Black recommendations chars-desc">
                                FLASH Recommendations
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc">
                                <strong><?php echo $mitigant->getLabel(); ?></strong><br />
                                <?php 
                                    echo '<p>' . $mitigant->getRecommendation() , '</p>';
                                    if ($mitigant->getCostMsg() != '') {
                                        echo "<p>" . $mitigant->getCostMsg() . "</p>";
                                    }
                                ?>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                <strong><?php echo $mitigant->getCostIndicator(); ?></strong>
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                <?php echo ($mitigant->getResources() != '') ? '<a href="' . $mitigant->getResources() . '" target="_blank">' . $mitigant->getResFriendlyName() . '</a>' : 'No resources available'; ?>
                            </div>
                            <div class="clear"></div>
                            
                            <!-- RDA-A-->
                            <?php $mitigant = $mitigants->getRdaA(); ?>
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <div class='col-md-1 col-xs-2 retrofits-icon'><img src="<?php echo SITE_ROOT; ?>/us/images/report-icons/rda-a.png" class="img-responsive retrofits-img" /></div>
                            <div class="col-md-3 col-sm-8 col-xs-8 retrofits-title"><h6>Deck Attach A</h6></div>
                            <div class="col-md-6 hidden-xs hidden-sm retro-hr"><hr></div>
                            <div class="clear"></div>
                            <div class="col-md-5  col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 white2230Black recommendations chars-desc">
                                FLASH Recommendations
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc">
                                <strong><?php echo $mitigant->getLabel(); ?></strong><br />
                                <?php 
                                    echo '<p>' . $mitigant->getRecommendation() , '</p>';
                                    if ($mitigant->getCostMsg() != '') {
                                        echo "<p>" . $mitigant->getCostMsg() . "</p>";
                                    }
                                ?>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                <strong><?php echo $mitigant->getCostIndicator(); ?></strong>
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                <?php echo ($mitigant->getResources() != '') ? '<a href="' . $mitigant->getResources() . '" target="_blank">' . $mitigant->getResFriendlyName() . '</a>' : 'No resources available'; ?>
                            </div>
                            <div class="clear"></div>
                            
                            <!-- RDA-B -->
                            <?php $mitigant = $mitigants->getRdaB(); ?>
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <div class='col-md-1 col-xs-2 retrofits-icon'><img src="<?php echo SITE_ROOT; ?>/us/images/report-icons/rda-b.png" class="img-responsive retrofits-img" /></div>
                            <div class="col-md-3 col-sm-8 col-xs-8 retrofits-title"><h6>Deck Attach B</h6></div>
                            <div class="col-md-6 hidden-xs hidden-sm retro-hr"><hr></div>
                            <div class="clear"></div>
                            <div class="col-md-5  col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 white2230Black recommendations chars-desc">
                                FLASH Recommendations
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc">
                                <strong><?php echo $mitigant->getLabel(); ?></strong><br />
                                <?php 
                                    echo '<p>' . $mitigant->getRecommendation() , '</p>';
                                    if ($mitigant->getCostMsg() != '') {
                                        echo "<p>" . $mitigant->getCostMsg() . "</p>";
                                    }
                                ?>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                <strong><?php echo $mitigant->getCostIndicator(); ?></strong>
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                <?php echo ($mitigant->getResources() != '') ? '<a href="' . $mitigant->getResources() . '" target="_blank">' . $mitigant->getResFriendlyName() . '</a>' : 'No resources available'; ?>
                            </div>
                            <div class="clear"></div>
                            
                            <!-- Water Barrier-->
                            <?php $mitigant = $mitigants->getWaterBarrier(); ?>
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <div class='col-md-1 col-xs-2 retrofits-icon'><img src="<?php echo SITE_ROOT; ?>/us/images/report-icons/water-barrier.png" class="img-responsive retrofits-img" /></div>
                            <div class="col-md-3 col-sm-8 col-xs-8 retrofits-title"><h6>Water Barrier</h6></div>
                            <div class="col-md-6 hidden-xs hidden-sm retro-hr"><hr></div>
                            <div class="clear"></div>
                            <div class="col-md-5  col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 white2230Black recommendations chars-desc">
                                FLASH Recommendations
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class="clear"></div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc">
                                <strong><?php echo $mitigant->getLabel(); ?></strong><br />
                                <?php 
                                    echo '<p>' . $mitigant->getRecommendation() , '</p>';
                                    if ($mitigant->getCostMsg() != '') {
                                        echo "<p>" . $mitigant->getCostMsg() . "</p>";
                                    }
                                ?>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                <strong><?php echo $mitigant->getCostIndicator(); ?></strong>
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc" id="lastResourceHeader">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                <?php echo ($mitigant->getResources() != '') ? '<a href="' . $mitigant->getResources() . '" target="_blank">' . $mitigant->getResFriendlyName() . '</a>' : 'No resources available'; ?>
                            </div>
                            <div class="clear"></div>
                            
                        </div> <!--  ./ Report Details -->


                    </div>  <!-- End wt-content wrapper -->
                </div>  <!-- End Characteristics Wrapper -->
            </div>  <!-- End Characteristics Inner -->
        </div> <!-- End Characteristics Container -->
        <div class='clear'></div>

        <div class='bottom-nav'>
            <div class="ccSave">
                    <div class="col-xs-12 col-sm-8 bottom-text slate2025Black">
                        Want to take your report on the go?
                    </div>
                    <div class='col-xs-10 col-xs-offset-1 col-sm-2 col-sm-offset-0 ccButtons ccButton-first'>                    
                        <a href="<?php echo HOME_LINK .'us/print.php'; ?>" target="_blank" class='mid-button-sand'><span class="blue2228Bold">Download</span></a>
                    </div>
                    <div class='col-xs-10 col-xs-offset-1 col-sm-2 col-sm-offset-0 ccButtons ccButton-middle'>                    
                        <a href="<?php echo HOME_LINK .'us/print.php'; ?>" target="_blank"  class='mid-button-sand'><span class="blue2228Bold">Print</span></a>
                    </div>
            </div>
            
        </div>
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>
        
        <script>
            $(document).ready( function() {
                if (screen.width < 768) {
                    var src = '<?php echo SITE_ROOT; ?>/us/images/calculator.png';
                    $(document.getElementById('slider')).attr('src', src); 
                }
            });
            
            $(window ).on({
                'load resize': function() {
                    var reportHeight = $(document.getElementById('reportWrapper')).height();
                    var wrapperTop = $(document.getElementById('reportWrapper')).position().top;
                    $(document.getElementById('ci')).height(reportHeight + wrapperTop);
                    
                    // Calculate height and top margin of line 1
                    var charMarkerTopPos = parseInt($(document.getElementById('topCharMarker')).css('marginTop')) + 1;
                    $(document.getElementById('cbmwt1')).css('height', wrapperTop + charMarkerTopPos);
                    $(document.getElementById('cbmwt1')).css('marginTop', 0 - wrapperTop);
                    console.log("Report Wrapper Top Position = " + wrapperTop);
                    console.log("Char Marker Top Position = " + charMarkerTopPos);
                    var charMarkerBotPos = parseInt($(document.getElementById('topCharMarkerCircle')).css('height'));
                    console.log("Char Marker Bottom Position = " + charMarkerBotPos);
                    
                    // Calc height  and top margin of line 2
                    $(document.getElementById('cbmwt2')).css('marginTop', charMarkerTopPos + charMarkerBotPos);
                    var reportHeaderContentHeight = parseInt($(document.getElementById('reportHeaderContent')).css('height')) + 1;
                    var reportHeaderHeight = parseInt($(document.getElementById('reportHeader')).css('height'));
                    var summaryPaddingTop = parseInt($(document.getElementById('reportSummary')).css('paddingTop'));
                    var midCharMarkerHeight = parseInt($(document.getElementById('midCharMarker')).css('height'));
                    console.log('Report Summary Top Padding = ' + summaryPaddingTop);
                    console.log('Report Header Content Height = ' + reportHeaderContentHeight);
                    console.log('Report Header Height = ' + reportHeaderHeight);
                    $(document.getElementById('cbmwt2')).css('height', summaryPaddingTop + reportHeaderContentHeight + reportHeaderHeight);
                    
                    // Calc height and top margin of line 3
                    var midCharMarkerBotPos = parseInt($(document.getElementById('midCharMarkerCircle')).css('height')) + 1;
                    var midCharMarkerTop = parseInt($(document.getElementById('midCharMarker')).css('marginTop'));
                    console.log('Mid Char Marker Top = ' + midCharMarkerTop);
                    $(document.getElementById('cbmwt3')).css('marginTop', midCharMarkerTop + midCharMarkerBotPos);
                    var reportSummaryHeight = parseInt($(document.getElementById('reportSummary')).css('height')) + 1;
                    $(document.getElementById('cbmwt3')).css('height', reportSummaryHeight - (midCharMarkerBotPos + midCharMarkerTop + summaryPaddingTop));
                    
                    // Calc height and top margin of line 4
                    var reportDetailPaddingTop = parseInt($(document.getElementById('reportDetails')).css('paddingTop'));
                    var reportDetailPaddingBot = parseInt($(document.getElementById('reportDetails')).css('paddingBottom'));
                    var reportDetailHeight = parseInt($(document.getElementById('reportDetails')).css('height'));
                    var reportDetailLastResourceHeader = parseInt($(document.getElementById('lastResourceHeader')).css('paddingBottom'));
                    console.log("Report Details Padding Top = " + reportDetailPaddingTop);
                    console.log("Report Details Padding Bottom = " + reportDetailPaddingBot);
                    console.log("Report Details Height = " + reportDetailHeight);
                    $(document.getElementById('cbmwt4')).css('marginTop', 0 - reportDetailPaddingTop);
                    $(document.getElementById('cbmwt4')).css('height', reportDetailHeight - (reportDetailPaddingTop + reportDetailPaddingBot) + reportDetailLastResourceHeader + 4);
                    
                    // Calculate top position of small mitigation cost box
                    var smallBox = $(document.getElementById('mitCostSmall'));
                    var smallBoxHeight = parseInt($(smallBox).css('height')) + parseInt($(smallBox).css('paddingTop')) + parseInt($(smallBox).css('paddingBottom'));
                    console.log("Mit Cost Small Box Height + Top and Bottom Padding = " + smallBoxHeight);
                    $(smallBox).css('margin-top', (reportSummaryHeight - smallBoxHeight) - summaryPaddingTop - 10);
                }
            });
            
            $("#cat1").click(function() {
                 $("#hCat").attr("value", 1);
                 $("#reportForm").submit(); 
            });
            $("#cat2").click(function() {
                 $("#hCat").attr("value", 2);
                 $("#reportForm").submit(); 
            });
            $("#cat3").click(function() {
                 $("#hCat").attr("value", 3);
                 $("#reportForm").submit(); 
            });
            $("#cat4").click(function() {
                 $("#hCat").attr("value", 4);
                 $("#reportForm").submit(); 
            });
            $("#cat5").click(function() {
                 $("#hCat").attr("value", 5);
                 $("#reportForm").submit(); 
            });
            
        </script>
    </body>
</html>
