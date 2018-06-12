<?php

/*
 * resre
 * config
 *
 * Description - Contains project-level constants used by the Resilient Residence application..
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             May 16, 2018 8:20:52 AM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */
// Set the project run mode
$resReEnv = 'dev';
global $root;
if ($resReEnv == 'dev') {
    // Path where the .ENV file with all the good stuff resides
    $envPath = 'C:/usr/Apache24/cgi-bin/resre/';
    // URL for the domain - no trailing slash
    define('SITE_ROOT', 'http://resre.jdac.ddns.net');
} else {
    // Path where the .ENV file with all the good stuff resides
    $envPath = '/home/<appOwner>/';
    // URL for the domain - no trailing slash
    define('SITE_ROOT', 'https://resilientresidence.com');
}
require( $root . 'vendor/autoload.php');
$dotenv = new Dotenv\Dotenv($envPath);
$dotenv->load();

// File system path for the root folder of the domain - no trailing slash
if ($resReEnv == 'dev') {
    define('WEB_ROOT','/source/web/resilientResidence/resre');
} else {
    define('WEB_ROOT', '/home/<siteOwner>/public_html');
}
// File system path for the project dir. No trailing slash
define('PROJECT_DIR','');
// Alias for SITE_ROOT
define('SITE_URL', SITE_ROOT);
// Path to Project URL - No Trailing Slashes
define('PROJECT_URL', '');

// Where should the "Home" link in the navigation go. Can be set to a temporary page for development.
if ($resReEnv == 'dev') {
    define('HOME_LINK','http://resre.jdac.ddns.net/');
} else {
    define('HOME_LINK', 'https://resilientresidence.com/');
}
// Full path to folder that will hold uploaded media. Must be writable by the server user account. Should be outside web root if possible (no trailing slash)
// define('UPLOAD_DIR',WEB_ROOT.PROJECT_DIR.'/_uploads');

// Path to (virtual?) folder that will hold uploaded media from the base URL of the domain (no  trailing slash)
// define('UPLOAD_URL',SITE_ROOT.'/_user_media');

// Title used throughout project
define('PROJECT_TITLE','Resilient Residence');
// Short Title used in E-mail subjects, HTML title tags and elsewhere
define('PROJECT_TITLE_SHORT','Resilient Residence');
// Page Titles

// E-mail addresses for server admin or primary contact
define('EMAIL_ADMIN','john@jdacsolutions.com');
if ($resReEnv == 'dev') {
    define('EMAIL_CONTACT', 'john@jdacsolutions.com');
} else {
    define('EMAIL_CONTACT', 'hello@resilientresidence.com');
}
// E-mail header separator. Usually CRLF (\r\n), but some poor quality Unix mail transfer agents replace LF by CRLF automatically (which leads to doubling CR if CRLF is used). 
// If messages are not received, try using a LF (\n) only. 
define('EMAIL_SEPARATOR',"\n");

// Set to TRUE on the production server
define('ARE_WE_LIVE', false);
        
# Unique session name. Can be altered if it conflicts with other server applications
define('SESSION_NAME','RESRE_ASSESS');
# Two unique strings that will be used in auto-redirect and login processes
define('TOKEN_NAME',SESSION_NAME.'-token');
define('POSTBACK_PARAMETER_PREFIX','__postback__');

// Google Maps API Key used for this application - These should be unique for each web project and not resused in production
// environments.
define('GOOGLE_MAPS_APIKEY', 'AIzaSyAFI9w0_CPPVjqorJ_c7Vv46PsXW32y7CE');

// Application-specific constants used in the estimation and carrier selection processes
// Used for image upload manipulations
const LOGO_WIDTH = array(200, 400, 600);
const LOGO_HEIGHT = array(108, 215,323);
define('LOGO_THUMBNAIL', 0);
define('LOGO_MED', 1);
define('LOGO_LG', 2);

// State names and abbreviations used in Lists
const STATES = array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
);

const NAV_STYLES = array(
    '/us/index.php' => 'slate2025Black',
    '/us/loc.php' => 'white2025Black',
    '/us/storeys.php' => 'white2025Black',
    '/us/stories.php' => 'white2025Black',
    '/us/wall-types.php' => 'white2025Black',
    '/us/shutters.php' => 'white2025Black',
    '/us/roof-shape.php' => 'white2025Black',
    '/us/garage-door.php' => 'white2025Black',
    '/us/roof-wall.php' => 'white2025Black',
    '/us/roof-deck-attach-A.php' => 'white2025Black',
    '/us/roof-deck-attach-B.php' => 'white2025Black',
    '/us/water-barrier.php' => 'white2025Black',
    '/us/complete.php' => 'white2025Black',
    '/us/report.php' => 'white2025Black',
    '/login.php' => 'white2025Black',
    '/signup.php' => 'white2025Black',
    '/pagestruct-test.php' => 'slate2025Black',
);
