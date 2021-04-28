<?php
$title = 'Error';
ob_start();
?>
<div>There is an error :</div>
<div>Message : <?= $message; ?></div>
<div>Code : <?= $code; ?></div>
<div>File : <?= $file; ?></div>
<div>Line : <?= $line; ?></div>

<?php
$content = ob_get_clean();
require('template.php');
?>