<?php
$root = '../';
require($root . '_includes/app_start.inc.php');
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
        <link href="<?php echo $root; ?>css/chars-styles.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/ccSave.css" rel='stylesheet' type='text/css' media="all" />
        <link href="<?php echo $root; ?>css/report.css" rel='stylesheet' type='text/css' media="all" />
    </head>
    <body style="background-color: var(--slate);">
        <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="characteristics rpt-wrapper">
            <div class="characteristics-inner">
                <div class="characteristics-wrapper">
                   <div class="wt-content-wrapper left"> 
                        <!-- Report Heading -->
                        <div class="row report-header">
                            <div class="chars-border-middle-wt-1"></div>
                            <div class="chars-border-middle-wt-2"></div>
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
                            <div class="col-md-10 col-xs-10 white2025Black report-title">
                                Resilient Residence Report
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10 col-xs-offset-2 topic"><h4 class="chars-h4">Jeff Lebowski's</h4></div>
                        </div>
                        <div class="row report-header section-padding">
                            <div class="col-md-10 col-sm-10 col-xs-10 col-xs-offset-2 chars-desc white2025">
                                The purpose of this report is to identify specific actions that you can take to strengthen your home against
                                hurricanes.  Please use this report as a resource to make your home as hurricane-resistant as possible.  
                                Contact a licensed, bonded, and insured contractor to plan your repairs and to ensure your home is ready 
                                for high winds.
                            </div>
                            <div class='clear'></div>
                            <div class='col-xs-10 col-xs-offset-1 col-sm-2 col-md-2 col-md-offset-1 rbuttons rbutton-first'>
                                <a href="#" class='mid-button-sand'><span class="blue2228Bold">Print</span></a>
                            </div>
                            <div class='col-xs-10 col-xs-offset-1  col-sm-2 col-md-2 rbuttons rbutton-middle'>
                                <a href="#" class='mid-button-sand'><span class="blue2228Bold">View</span></a>
                            </div>
                            <div class='col-xs-10 col-xs-offset-1 col-sm-2 col-md-2 rbuttons  rbutton-last'>
                                <a href="#" class='mid-button-sand'><span class="blue2228Bold">Share</span></a>
                            </div>
                        </div>
                        <!-- Report Summary -->
                        <div class='row report-summary '>
                            <div class='chars-border-middle-wt-3'></div>
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
                            <div class='mit-cost-small white2025 hidden-md hidden-lg'>
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
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-white" style="margin-bottom: 0px; ">
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
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker chars-bumper"><span class="blue2532Bold marker-white rating" style="margin-bottom: 0px; ">1</span></div>
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker"><span class="blue2532Bold marker-white rating" style="margin-bottom: 0px; ">2</span></div>
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker"><span class="blue2532Bold marker-white rating" style="margin-bottom: 0px; ">3</span></div>
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker"><span class="blue2532Bold marker-white rating" style="margin-bottom: 0px; ">4</span></div>
                            <div class="col-md-1 col-sm-1 col-xs-1 chars-marker rating-marker"><span class="blue2532Bold marker-white rating" style="margin-bottom: 0px; ">5</span></div>
                            <div class='clear'></div>
                            <div class="col-md-8 col-sm-10 col-xs-10 risk white2025">
                                Your annual risk of a category <$var> hurricane is <strong><$varPct></strong>.
                            </div>
                            <div class="col-md-8 col-sm-10 col-xs-10 risk report-title white2532Bold">
                                Damage & Calculator Cost Analysis
                            </div>
                            <div class="col-md-8 col-sm-10 col-xs-10 chars-bumper">
                                <img src="<?php echo SITE_ROOT; ?>/us/images/spectrum.png"  id='slider' class="img-responsive report-slider"/>
                            </div>
                            <div class='clear'></div>
                            <div class='col-md-1 col-md-offset-3 col-xs-4 col-xs-offset-2 white2532Bold' style='text-align: right;'><$varAfter></div>
                            <div class='col-md-1 col-md-offset-1 col-xs-4 white2532Bold'><$varBefore></div>
                            <div class='clear'></div>
                            <div class='col-md-1 col-md-offset-3 col-xs-4 col-xs-offset-2 white1822' style="text-align: center;">After</div>
                            <div class='col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-2 col-xs-4 white1822'>Before</div>
                            <div class='clear'></div>
                        </div> <!-- End summary row -->
                        <!-- Retrofit Suggestions -->
                        <div class='row report-details'>
                            <div class='chars-border-middle-wt-4'></div>
                            <div class='retrofits-header white3040'>Suggested Retrofits</div>
                            <!-- Wall Types -->
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
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
                                Congratulations, your selection indicates that your roof deck attachment is superior and can provide additional 
                                protection to your home.
                            </div>
                            <div class="col-xs-10 col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-md-offset-0 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                Brace Walls - $$
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                Document 1 - <a href="#" target="_blank">Download PDF</a><br />
                                Document 2 - <a href="#" target="_blank">Download PDF<a>
                            </div>
                            <div class='clear'></div>
                            <!-- Shutters -->
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
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
                                Protect all openings with a shutter or impact resistant glazing that meets one the the following large missle 
                                impact tests:<br />&nbsp;<br />
                                <ul>
                                    <li>Miami-Dade TAS 201, 202 and 203</li>
                                    <li>SSTD 12</li>
                                    <li>ATSM E 1886 & 1996</li>
                                </ul>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                Add Shutters - $$
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                No resources available
                            </div>
                            <div class="clear"></div>
                            <!-- Roof Shape -->
                            <div class="col-md-2 col-sm-2 col-xs-2 chars-marker chars">
                                <span class="blue2532Bold marker-sand" style="margin-bottom: 0px; ">
                                    <img src="<?php echo SITE_ROOT; ?>/us/images/arrow_blue-dark.png" class="img-responsive complete-down"/>
                                </span>
                            </div>
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
                                Hipped roofs provide the best protection against high winds.  However, roof replacement is costly.
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                Replace Roof - $$$$
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                Document 1 - <a href="#" target="_blank">Download PDF</a><br />
                                Document 2 - <a href="#" target="_blank">Download PDF<a>
                            </div>
                            <div class="clear"></div>
                            <!-- Garage -->
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
                               Impact rated garage doors provide the most protection against severe weather.
                            </div>
                            <div class="col-xs-8 col-xs-offset-2 hidden-md hidden-lg white2230Black costs chars-desc">
                                Costs
                            </div>
                            <div class='col-md-4 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-desc rec-desc-no-bumper'>
                                Replace Garage Door - $$$
                            </div>
                            <div class="col-md-8  col-md-offset-2 col-xs-8 col-xs-offset-2 white2230Black resources chars-desc">
                                Resources
                            </div>
                            <div class="col-md-5 col-xs-10 col-xs-offset-2 chars-bumper slate2230 rec-resources">
                                Document 1 - <a href="#" target="_blank">Download PDF</a><br />
                            </div>
                            <div class="clear"></div>

                        </div> <!--  ./ Report Details -->


                    </div>  <!-- End wt-content wrapper -->
                </div>  <!-- End Characteristics Wrapper -->
            </div>  <!-- End Characteristics Inner -->
        </div> <!-- End Characteristics Container -->
        <div class='clear'></div>

        <div class='bottom-nav'>
            <div class="row ccSave">
                    <div class="col-md-4 col-md-offset-1 col-sm-6 col-xs-10 col-xs-offset-2 bottom-text slate2025Black">
                        Want to take your report on the go?
                    </div>
                    <div class='col-md-2 col-md-offset-0 col-sm-2 col-sm-offset-0 col-xs-10 col-xl-offset-1 ccButtons ccButton-first'>                    
                        <a href="<?php echo HOME_LINK; ?>us/<?php echo $continue; ?>.php" class='mid-button-sand'><span class="blue2228Bold">Download</span></a>
                    </div>
                    <div class='col-md-2 col-md-offset-0 col-sm-2 col-sm-offset-0 col-xs-10 col-xl-offset-2 ccButtons ccButton-middle'>                    
                        <a href="<?php echo HOME_LINK; ?>us/<?php echo $back; ?>.php" class='mid-button-sand'><span class="blue2228Bold">Print</span></a>
                    </div>
                    <div class='col-md-2 col-md-offset-0 col-sm-2 col-sm-offset-0 col-xs-10 col-xl-offset-1 ccButtons ccButton-last'>                    
                        <a href="<?php echo HOME_LINK; ?>us/index.php" class='mid-button-sand'><span class="blue2228Bold">Share</span></a>
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
        </script>
    </body>
</html>
