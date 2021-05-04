<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?= $title; ?></title>
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