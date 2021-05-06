<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?= $title; ?></title>
    <link href="./public/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <?= $style ?>
</head>

<body>
    <?php include "menu.php"; ?>

    <?= $content; ?>
    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>

</html>