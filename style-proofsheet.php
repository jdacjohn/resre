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
            Text Style 1
            <p class="pg3040">
                Example of text style 1 <br />
                30px, leading 40px, pale green foreground, Encode+Sans<br />
                CSS Class = pg3040
            </p>
            Text Style 2
            <p class="slate3040">
                Example of text style 2 <br />
                30px, leading 40px, slate foreground, Encode+Sans <br />
                CSS Class = slate3040
            </p>
            Text Style 3
            <p class="white3040">
                Example of text style 3 <br />
                30px, leading 40px, white foreground, Encode+Sans <br />
                CSS Class = white3040
            </p>
            Text Style 4
            <p class="white2532Bold">
                Example of text style 4 <br />
                25px, leading 32px, white foreground, Encode+Sans Bold. <br />
                CSS Class = white2532Bold
            </p>
            Text Style 5
            <p class="blue2532Bold">
                Example of text style 5 <br />
                25px, leading 32px, blue foreground, Encode+Sans Bold. <br />
                CSS Class = blue2532Bold
            </p>
            Text Style 6
            <p class="white2230Black">
                Example of text style 6 <br />
                22px, leading 30px, white foreground, Encode+Sans Black. <br />
                CSS Class = white2230Black
            </p>
            Text Style 7
            <p class="pg2230Black">
                Example of text style 7 <br />
                22px, leading 30px, pale green foreground, Encode+Sans Black. <br />
                CSS Class = pg2230Black
            </p>
            Text Style 8
            <p class="slate2230">
                Example of text style 8 <br />
                22px, leading 30px, slate foreground, Encode+Sans. <br />
                CSS Class = slate2230
            </p>
            Text Style 9
            <p class="sand2230Black">
                Example of text style 9 <br />
                22px, leading 30px, sand foreground, Encode+Sans Black. <br />
                CSS Class = sand2230Black
            </p>
            Text Style 10
            <p class="blue2228Bold">
                Example of text style 10 <br />
                22px, leading 28px, blue foreground, Encode+Sans Bold. <br />
                CSS Class = blue2228Bold
            </p>
            Text Style 11
            <p class="white2230">
                Example of text style 11 <br />
                22px, leading 30px, white foreground, Encode+Sans. <br />
                CSS Class = white2230
            </p>
            Text Style 12
            <p class="white2025Black">
                Example of text style 12 <br />
                20px, leading 25px, white foreground, Encode+Sans Black. <br />
                CSS Class = white2025Black
            </p>
            Text Style 13
            <p class="slate2025">
                Example of text style 13 <br />
                20px, leading 25px, slate foreground, Encode+Sans. <br />
                CSS Class = slate2025
            </p>
            Text Style 14
            <p class="white2025">
                Example of text style 14 <br />
                20px, leading 25px, white foreground, Encode+Sans. <br />
                CSS Class = white2025
            </p>
            Text Style 15
            <p class="slate2025Black">
                Example of text style 15 <br />
                20px, leading 25px, slate foreground, Encode+Sans Black. <br />
                CSS Class = slate2025Black
            </p>
            Text Style 16
            <p class="white2025Bold">
                Example of text style 16 <br />
                20px, leading 25px, white foreground, Encode+Sans Bold. <br />
                CSS Class = white2025Bold
            </p>
            Text Style 17
            <p class="mustard2025Black">
                Example of text style 17 <br />
                20px, leading 25px, mustard foreground, Encode+Sans Black. <br />
                CSS Class = mustard2025Black
            </p>
            Text Style 18
            <p class="white1640Bold">
                Example of text style 18 <br />
                16px, leading 40px, white foreground, Encode+Sans Bold. <br />
                CSS Class = white1640Bold
            </p>
            Text Style 19
            <p class="blue1620Bold">
                Example of text style 19 <br />
                16px, leading 20px, blue foreground, Encode+Sans Bold. <br />
                CSS Class = blue1620Bold
            </p>
            Text Style 20
            <p class="slate1640Bold">
                Example of text style 20 <br />
                16px, leading 40px, slate foreground, Encode+Sans Bold. <br />
                CSS Class = slate1640Bold
            </p>
            Text Style 21
            <p class="white1220Black">
                Example of text style 21 <br />
                12px, leading 20px, white foreground, Encode+Sans Black. <br />
                CSS Class = white1220Black
            </p>
            Text Style 22
            <p class="white1220">
                Example of text style 22 <br />
                12px, leading 20px, white foreground, Encode+Sans. <br />
                CSS Class = white1220
            </p>
            Text Style 23
            <p class="offwhite1215EB">
                Example of text style 23 <br />
                12px, leading 15px, white foreground, Encode+Sans Extra Bold. <br />
                CSS Class = offwhite1215EB
            </p>
        </body>
    </html>
