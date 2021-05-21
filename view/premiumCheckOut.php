<?php
$title = 'Premium';
$style = '<link href="./public/css/premium.css" rel="stylesheet" /> 
<link href="./public/css/profile.css" rel="stylesheet" />
<link href="./public/css/bottomLanding.css" rel="stylesheet" />';
ob_start();
?>

<section>
    <h1><?= ucfirst($whichPlan) ?>ly Plan</h1>
    <p>We are really happy to see you joining us for one <strong><?= $whichPlan ?> !!</strong> <br>
        The total price to get full access to the premium account is <strong><?= $pricing ?>$</strong>
        <br>
        <br>
        By joining today <strong><?= date("Y/m/d") ?></strong> your subsciption would last until <strong><?= $expirationDate->format('Y-m-d'); ?></strong>,
        you are almost there, please fill up your card information and hit the submit button.

    </p>

    <form id="premiumForm" action="index.php" method="post">
        <input hidden name="action" value="submitPremium">
        <input hidden name="expDate" value="<?= $expirationDate->format('Y-m-d'); ?>">

        <div>
            <input type="text" name="cardHolder" id="cardHolder" placeholder="Your Name">
            <input type="text" name="cardNumber" id="cardNumber" placeholder="Card Number">
        </div>
        <div>
            <div>
                <input type="date" name="expirationCard" id="expirationCard">
            </div>
            <div>
                <input type="text" name="cvc" id="cvc" placeholder="CVC">
            </div>
        </div>

        <input type="submit" class="signUpBtn" value="Pay $<?= $pricing ?>">
    </form>

</section>


<?php

$content = ob_get_clean();
require("template.php");
