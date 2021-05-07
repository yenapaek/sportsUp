<?php
$title = 'Error';
$style = '<link href="./public/css/style.css" rel="stylesheet" />';
ob_start();
?>
<div>There is an error :</div>
<div>Message : <?= $message; ?></div>
<div>Code : <?= $code; ?></div>
<div>File : <?= $file; ?></div>
<div>Line : <?= $line; ?></div>

<div>
    <p>
        <img style="width:200px;" src="./public/images/error/kakao.png" alt="Ryan">
    </p>
</div>

<?php
$content = ob_get_clean();
require('template.php');
?>