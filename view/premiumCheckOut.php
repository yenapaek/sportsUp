<?php
$title = 'Premium';
$style = '<link href="./public/css/premium.css" rel="stylesheet" /> 
<link href="./public/css/profile.css" rel="stylesheet" />
<link href="./public/css/bottomLanding.css" rel="stylesheet" />';
ob_start();



?>

<section>
    <h1><?= $plan ?> Plan</h1>
    <p>We are really happy to see you joining us for one <?= $plan ?> !! <br>
        The total price to get full access to the premium account is <?= $pricing ?>$
        <br>
        <br>
        By joining today <?= date("Y/m/d") ?> and your subsciption would last until <?= $expirationDate->format('Y-m-d'); ?>
        You are almost there, please fill up ur card information and submit.

    </p>

</section>


<?php

$content = ob_get_clean();
require("template.php");
