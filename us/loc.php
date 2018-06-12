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
        <title><?php echo PROJECT_TITLE_SHORT; ?> Home Location</title>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
    </head>
    <body>
       <?php include_once($root . 'includes/nav-menu.php'); ?>
        <div class="carousel container-fluid">
            <div id="carousel" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo $root; ?>us/images/us-loc-bg.png" class="carousel_img" alt="#" style="max-height: 640px" />
                        <div class="carousel-caption container half_padding_left half_padding_right">
                            <div class="carousel-content-wrapper left">
                                <div class="col-xs-12 col-md-10 carousel-header-text white3040">
                                    The location of your home will allow us to determine your risk of hurricanes and how much wind and flooding can be expected.
                                </div>
                                <form method="post" name="locForm" action="storeys.php">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-4 carousel-header-button loc-push-down">
                                        <a href="#" class="header-button"><span class="blue2228Bold">Find my location</span></a>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-8 loc-pull-up">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-8 fix-left"><label class="offwhite1215EB" style="margin-bottom: 0px; " for="input_geoLoc">Enter city name or zip</label></div>
                                                <div class="col-xs-12 col-md-8 fix-left fix-top">
                                                    <input type="text" class="white2532 form-paleBlue" name="input_geoLoc" id="input_geoLoc" value="<?php echo isset($_POST['input_geoLoc']) ? $_POST['input_geoLoc'] : ''; ?>" placeholder="Corpus Christi, Texas" />
                                                    <div>
                                                        <input data-geo-home="location" type="hidden" name="geo-home-location" id="geo-start-location" value="" />
                                                        <input data-geo-home="route" type="hidden" name="geo-home-route" value="" />
                                                        <input data-geo-home="street_number" type="hidden" name="geo-home-street_number" value="" />
                                                        <input data-geo-home="postal_code" type="hidden" name="geo-home-postal_code" value="" />
                                                        <input data-geo-home="locality" type="hidden" name="geo-home-locality" value="" />
                                                        <input data-geo-home="country_short" type="hidden" name="geo-home-country_short" value="" />
                                                        <input data-geo-home="administrative_area_level_1" type="hidden" name="geo-home-state" value="" />
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div> <!-- . / container-fluid -->
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div><!-- /carousel_content_wrapper -->
                    </div><!-- /item -->
                </div><!-- /carousel-inner -->
            </div><!-- /carousel -->      
        </div><!-- /carousel container -->
        
        <div class="container" style="height: 125px;">
            <div class="row questionairre no-padding-bottom no-padding-top paleGreen">
                    <div class="border-middle-loc"></div>
                    <div class="border-middle-loc-hide-all"></div>
                    <div class='col-xs-5 col-xs-offset-1 col-md-5 col-md-offset-1 centerline loc-centerline-fix'>                    
                        <a href="<?php echo HOME_LINK; ?>us/storeys.php" class='mid-button-mustard'><span class="blue2228Bold">Continue</span></a>
                    </div>
                    <div class='col-xs-5 col-xs-offset-1 col-md-5 right centerline loc-centerline-fix' style='text-align: center;'>
                        <a href="<?php echo HOME_LINK; ?>us/index.php" class='mid-button-sand'><span class="blue2228Bold">Back</span></a>
                    </div>
            </div>
        </div>   <!-- / .containter -->
        
        <!-- Footer -->
        <?php include($root . 'includes/site-footer.php'); ?>
        <!-- Core JavaScript Files -->
        <?php require($root . 'includes/page-bottom-scripts.php'); ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_APIKEY; ?>&libraries=places"></script>
        <script src="<?php echo $root; ?>js/jquery.geocomplete.js"></script>
        <script src="<?php echo $root; ?>js/ww.jquery.js"></script>
        <script>
            $("#input_geoLoc").geocomplete({
                details: "form div",
                detailsAttribute: "data-geo-home",
                autoselect: false,
                blur: false,
                geocodeafterresult: false,
                types: ['(regions)'],
                componentRestrictions:  
                    { country: 'us' }
            });
</script>
    </body>
</html>
