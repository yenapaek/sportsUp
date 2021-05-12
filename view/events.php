<?php
$title = "Events";
$style = '<link href="./public/css/events.css" rel="stylesheet" />';
?>
<?php ob_start(); ?>

<div id="mainContainer">

    <header>
        <form action="" id="formCriteria" method="POST">
            <input type="hidden" name="action" value="searchSubmit">
            <div id="searchWrapper">
                <label for="searchTitle">Choose your criteria</label>
            </div>
            <div id="searchBar">
                <select name="selectCriteria" id="selectCriteria" dataUserId="<?= $_SESSION['userId'] ?>">
                    <option value="Event" selected>By Event</option>
                    <option value="Sport">By Sport</option>
                    <option value="Popularity">By Popularity</option>
                    <option value="Recently">Most Recent</option>
                    <?php  if(isset($_SESSION['userId'])) { ?> <option value="FavoritesEvents">Favorites Events</option> <?php } ?>
                </select>
                <div id="sportSelect">
                    <select name="sportsCriteria" id="sportsCriteria">
                        <option value="default" selected disbled>Select Your Sport</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category["name"]; ?>"><?= $category["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="text" name="searchEvent" id="searchInput" placeholder="Type Here">
            </div>
            <div>
                <input type="submit" value="search" id="submitButton">
            </div>
        </form>
    </header>

    <section>
        <div>List of events</div>
    </section>

    <section>
        <?php require('eventList.php') ?>
    </section>
</div>
<script src="./public/js/events.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>