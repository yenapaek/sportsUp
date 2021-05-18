<?php
$title = 'Premium';
$style = '<link href="./public/css/premium.css" rel="stylesheet" /> 
<link href="./public/css/profile.css" rel="stylesheet" />
<link href="./public/css/bottomLanding.css" rel="stylesheet" />';
ob_start();

require('premiumPlanView.php');

$content = ob_get_clean();
require("template.php");
