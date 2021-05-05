<?php $title = !isset($title) ? "Profile" : $title;
$style = "./public/css/profile.css"; ?>
<?php ob_start(); ?>
<p><a href="index.php">Back to HOMEPAGE</a></p>
<h1>I am a Profile PAGE</h1>

<section id="personnalInfo">

    <div id="myInfos">
        <div class="titleEdit">
            <h1>My infos</h1>
            <button>Modify infos</button>
        </div>

        <div>
            <!-- INFO FROM DATABASE -->
            <p>UserName : </p>
            <p>FirstName :</p>
            <p>LastName : </p>
            <p>Birthday : </p>
            <p>Email : </p>
            <p>Nationality : </p>
            <p>City : </p>
        </div>
    </div>

    <div id="mySports">
        <div class="titleEdit">
            <h1>My sport</h1>
            <button>Add Sport</button>
        </div>
        <div>
            <!-- INFO FROM DATABASE -->
            <ul>
                <li>Tennis</li>
                <li>Basket</li>
                <li>Football</li>
            </ul>
        </div>
    </div>
</section>
<section id="eventInfo">

    <div id="myEvents">
        <h1>My Events</h1>
        <div>
            <div class="titleEdit">
                <h2>Created</h2>
                <button>Create Event</button>
                <!-- INFO FROM DATABASE -->
            </div>
            <div>
                <h2>Attenting</h2>
                <!-- INFO FROM DATABASE -->
            </div>
        </div>
    </div>

    <div>
        <h1>Suggestion</h1>
        <!-- INFO FROM DATABASE -->
    </div>
</section>
<section id="articleInfo">
    <div>
        <h1>My Articles</h1>
        <!-- INFO FROM DATABASE -->
    </div>
    <div>
        <h1>Suggestion</h1>
        <!-- INFO FROM DATABASE -->
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>