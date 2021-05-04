<?php $title = "Profile" ?>
<?php $style = "./public/css/profile.css"; ?>

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
            <p>UserName : <?= !empty($infoProfil) ? $infoProfil['userName'] : '...'; ?></p>
            <p>FirstName : <?= !empty($infoProfil['firstName']) ? $infoProfil['firstName'] : '...'; ?></p>
            <p>LastName : <?= !empty($infoProfil['lastName']) ? $infoProfil['lastName'] : '...' ?></p>
            <p>Birthday : <?= !empty($infoProfil['birthDate']) ? $infoProfil['birthDate'] : '...'; ?></p>
            <p>Email : <?= !empty($infoProfil['email']) ? $infoProfil['email'] : '...' ?></p>
            <p>Nationality : <?= !empty($infoProfil['nationality']) ? $infoProfil['nationality'] : '...' ?></p>
            <p>City : <?= !empty($infoProfil['city']) ? $infoProfil['city'] : '...' ?></p>
        </div>
    </div>

    <div id="mySports">
        <div class="titleEdit">
            <h1>My sport</h1>
            <button>Add Sport</button>
        </div>
        <div>
            <ul>
                <?php
                if (!empty($mySports)) {
                    foreach ($mySports as $sport) {
                ?>
                        <li><?= $sport['category_name']; ?></li><br>
                <?php
                    }
                } else {
                    echo '<li> No sport added</li>';
                }
                ?>
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