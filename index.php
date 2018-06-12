<?php
    $root = './';
    require('_includes/app_start.inc.php');

?>
<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <!-- Load site meta information -->
        <?php include($root . 'includes/page-head-meta.php'); ?>
        <title>Resilient Residence</title>
        <!-- Load site CSS -->
        <?php include($root . 'includes/page-styles.php'); ?>
        <!-- Load Page HEAD script files -->
        <?php include($root . 'includes/page-head-scripts.php'); ?>
    </head>
        <body>
            <?php
            $dbConn = db_connect();
            if ($dbConn) {
                echo "Connected to DB Successfully.<br />";
                mysqli_close($dbConn);
            } else {
                echo 'Could not connect to DB<br />';
            }
            ?>
            <p>Style Proofing Sheet</p>
            <h1>Example Heading 1</h1>
            <h2>Example Heading 2</h2>
            <h3>Example Heading 3</h3>
            <h4>Example Heading 4</h4>
            <h5>Example Heading 5</h5>
            <h6>Example Heading 6</h6>
        </body>
    </html>
