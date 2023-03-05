<!-- main content template-->
<?php ob_start();?>
<section class="dmc">
    <div class="dmc-about">
        <h2>DMC Delorean</h2>
        <p>3 Cup holders</p>
        <p>Superman doors</p>
        <p>Fuzzy dice!</p>
    </div>
    <img id="delorean-img" src="/phpmotors/images/delorean.jpg" alt="delorean photo">
    <div id="dmc-button">
        <a href="https://localhost/phpmotors/home.php">
            <img src="/phpmotors/images/site/own_today.png" alt="own delorean today button">
        </a>
</div>
</section>

<section id="delorean-info" class="flex-container">
    <div class="dmc-reviews">
        <h3>DMC Delorean Reviews</h3>
        <ul>
            <li>"So fast its almost like traveling in time." (4/5)</li>
            <li>"Coolest ride on the road." (4/5)</li>
            <li>"I'm feeling Marty McFly" (5/5)</li>
            <li>"The most futuristic ride of our day" (4.5/5)</li>
            <li>"80's livin and I love it!" (5/5)</li>
        </ul>
    </div>
    <div>
        <h3>Delorean Upgrades</h3>
        <div class="dmc-upgrades">

            <div class="flux">
                <div class="img-div"><img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux capacitor"></div>

                <a href="#">Flux Capacitor</a>
            </div>
            <div class="flame">
                <div class="img-div"><img src="/phpmotors/images/upgrades/flame.jpg" alt="flame decals"></div>

                <a href="#">Flame Decals</a>
            </div>
            <div class="bumper">
                <div class="img-div"><img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper sticker"></div>

                <a href="#">Bumper Sticker</a>
            </div>
            <div class="hub">
                <div class="img-div"><img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub caps"></div>

                <a href="#">Hub Caps</a>
            </div>
        </div>
    </div>
</section>

<!-- variables for template -->
<?php
$page_heading = "Welcome to PHP Motors!";
$page_content = ob_get_clean();
?>

<!-- template call -->
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/template.php'; ?>
