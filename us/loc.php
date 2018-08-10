<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');
    $home = '';
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        // Get the ResReHome object from the session
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    } else {
        // First time here - Create a new ResReHome object.
        $home = new resre\ResReHome();
    }
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
        <link href="<?php echo $root; ?>css/chars-borders.css" rel='stylesheet' type='text/css' media="all" />
        <?php include($root . 'includes/page-styles.php'); ?>
        <link href="<?php echo $root; ?>css/loc.css" rel='stylesheet' type='text/css' media="all" />
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
                                <form method="post" name="locForm" id="locForm" action="<?php echo SITE_ROOT . '/_includes/procCrit/procUSLoc.php'; ?>">
                                    <input type='hidden' name='postFrom' id="postFrom" value='__us-loc__' />
                                    <div class="row">
                                        <!-- <div class="col-xs-12 col-sm-6 col-md-4 carousel-header-button loc-push-down">
                                            <a href="#" class="header-button"><span class="blue2228Bold">Find my location</span></a>
                                        </div> -->
                                        <div class="col-xs-12 col-sm-6 col-md-8 loc-pull-up">
                                            <div class="container-fluid">
                                                <div class="row loc-form">
                                                    <div class="col-xs-12 col-md-8 fix-left"><label class="offwhite1215EB" style="margin-bottom: 0px; " for="input_geoLoc">Enter your zip code</label></div>
                                                    <div class="col-xs-12 col-md-8 fix-left fix-top">
                                                        <input type="text" class="white2532 form-paleBlue" name="input_geoLoc" id="input_geoLoc" value="<?php echo $home->geoLoc; ?>" placeholder="Corpus Christi, Texas 78418 USA" />
                                                        <div>
                                                            <input data-geo-home="location" type="hidden" name="geo-home-location" id="geo-start-location" value="<?php echo $home->latLng; ?>" />
                                                            <input data-geo-home="route" type="hidden" name="geo-home-route" value="<?php echo isset($_SESSION[SESSION_NAME]['property']['homeRoute']) ? $_SESSION[SESSION_NAME]['property']['homeRoute'] : ''; ?>" />
                                                            <input data-geo-home="street_number" type="hidden" name="geo-home-street_number" value="<?php echo isset($_SESSION[SESSION_NAME]['property']['streetNo']) ? $_SESSION[SESSION_NAME]['property']['streetNo'] : ''; ?>" />
                                                            <input data-geo-home="postal_code" type="hidden" name="geo-home-postal_code" value="<?php echo $home->zipCode; ?>" />
                                                            <input data-geo-home="locality" type="hidden" name="geo-home-locality" value="<?php echo $home->locality; ?>" />
                                                            <input data-geo-home="country_short" type="hidden" name="geo-home-country_short" value="<?php echo $home->country; ?>" />
                                                            <input data-geo-home="administrative_area_level_1" type="hidden" name="geo-home-state" value="<?php echo $home->state; ?>" />
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

        <div class="bottom-nav">
            <div class="row ccSave">
                <div class="chars-border-middle-wt-1"></div>
                <div class='col-xs-3 col-xs-offset-1 col-sm-6 col-sm-offset-0 ccSave-fix-left'>                    
                    <a class='mid-button-mustard' onclick="document.getElementById('locForm').submit();"><span class="blue2228Bold">Continue</span></a>
                </div>
                <div class='col-xs-3 col-xs-offset-3 col-sm-6 col-sm-offset-0 ccSave-fix-right'>
                    <a class='mid-button-sand' id="moveBack"><span class="blue2228Bold">Back</span></a>
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
                        {country: 'us'}
            });
                            
            $(window ).on({
                'load': function() {
                    $(window).attr('innerDocClick', false);
                }
            });
            
           $("#moveBack").click(function() {
               $("#locForm").attr("action", "<?php echo HOME_LINK; ?>_includes/procCrit/procUSHome.php");
               $("#locForm").submit(); 
           });
        </script>
    </body>
</html>
