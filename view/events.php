<?php
$title = "Events";
$style = '<link href="./public/css/events.css" rel="stylesheet"/>';
?>
<?php ob_start(); ?>

<div id="mainContainer">
    <header>
        <form action="" id="formCriteria" method="POST">
            <input type="hidden" name="action" value="searchSubmit">
            <div id="searchWrapper">
                <label for="searchTitle">Search</label>
            </div>
            <div id="searchBar">
                <select name="selectCriteria" id="selectCriteria">
                    <option value="Event" selected>By Event Name</option>
                    <option value="Sport">By Sports Category</option>
                </select>
                <div id="sportSelect">
                    <select name="sportsCriteria" id="sportsCriteria">
                        <option value="default" selected disabled>Select Your Sport</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category["name"]; ?>"><?= $category["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="text" name="searchEvent" id="searchInput" placeholder="Type Here">
            </div>
            <div>
                <input type="submit" value="Apply" id="submitButton">
            </div>
        </form>
        <!-- <h3 class="or">Or create your own</h3> -->
        <?php 
            if (isset($_SESSION['userId'])):
        ?>
                <div id="createEventBox">
                    <a href="index.php?action=addEditEvent" class="createEventBtn">Create Event</a> 
                </div>
        <?php
            endif;
        ?>
    </header>
    <section>
        <div>List of events</div>
    </section>
    <section>
        <?php
        if (!empty($events)) {
            require('eventList.php');
        } ?>
    </section>
</div>

<script src="./public/js/events.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>