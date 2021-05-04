<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="./public/css/style.css" rel="stylesheet" /> 
    <link href="<?= $style?>" rel="stylesheet" />  
</head>

<body>
    <?php include "menu.php";?>

    <?= $content; ?>
    <footer>
        <?php include "footer.php";?>
    </footer>
</body>

</html>