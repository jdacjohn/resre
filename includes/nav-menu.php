<?php 
   // echo $_SERVER['PHP_SELF'] . '<br />'; 
    $navStyle = NAV_STYLES[$_SERVER['PHP_SELF']];
    //echo $navStyle . '<br />';
?>
<!-- Standard Bootstrap nav-bar with 2 child elements - No Form used  -->
<!--    <nav class="navbar custom-navbar" role="navigation"> -->
    <nav class="navbar custom-navbar navbar-static-top" role="navigation" id="topNav">
       <div class="container-fluid">
            <div class="navbar-wrapper">
                <!-- Child Element 1 - Standard Bootstrap Navbar header -->
                <!-- <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
                        <span class="sr-only">Show/Hide Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> -->
                <!-- Element 2 - nav-bar options -->
                <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll <?php echo $navStyle; ?>" href="<?php echo SITE_ROOT . '/us/'; ?>index.php">Home</a></li>
                        <li><a class="page-scroll <?php echo $navStyle; ?>    " href="#">Help</a></li>
                        <?php
                            if ( isset($_SESSION[SESSION_NAME]['user']['logged_in']) && $_SESSION[SESSION_NAME]['user']['logged_in'] == true) {
                        ?>
                        <li><a class="page-scroll mustard2025Black" href="<?php echo SITE_ROOT . '/'; ?>us/index.php?postFrom=__logout__">Logout</a></li>
                            <?php } ?>
                    </ul>
                </div>
            <!-- Search Form would typically go here -->
            </div> <!-- navbar-wrapper -->
        </div> <!-- container-fluid -->
    </nav>	
