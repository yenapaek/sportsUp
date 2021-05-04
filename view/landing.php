<?php $title = !isset($title) ? "Landing" : $title; ?>
<?php $style = ""; ?>

<?php ob_start(); ?>
<h1>I AM a LANDING PAGE</h1>
<a href="index.php?action=signIn">signIn</a>
<br>
<a href="index.php?action=signUp">signUp</a>
<br>
<a href="index.php?action=profile">Profile</a>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>