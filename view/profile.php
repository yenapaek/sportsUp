<?php $title = !isset($title) ? "Profile" : $title;
$style = "./public/css/profile.css"; ?>
<?php ob_start(); ?>
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

        <div class="titleEdit">
            <h2>Created</h2>
            <button>Create Event</button>
            <!-- INFO FROM DATABASE -->
        </div>
        <div>
            <ul>
                <?php
                if (!empty($myEvents)) {
                    foreach ($myEvents as $event) {
                ?>
                        <li><?= $event['FillMeUp']; ?></li><br>
                <?php
                    }
                } else {
                    echo '<li> No events</li>';
                }
                ?>
            </ul>
        </div>
        <div class="titleEdit">
            <h2>Attenting</h2>
        </div>
        <!-- INFO FROM DATABASE -->
        <div>
            <ul>
                <?php
                if (!empty($attendingEvents)) {
                    foreach ($attendingEvents as $attentingevent) {
                ?>
                        <li><?= $attentingevent['FillMeUp']; ?></li><br>
                <?php
                    }
                } else {
                    echo '<li> No events</li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <div id="myEventsSuggestion">
        <h1>Suggestion</h1>
        <!-- INFO FROM DATABASE -->
        <div>
            <ul>
                <?php
                if (!empty($suggestionEvents)) {
                    foreach ($suggestionEvents as $suggestionEvent) {
                ?>
                        <li><?= $suggestionEvent['FillMeUp']; ?></li><br>
                <?php
                    }
                } else {
                    echo '<li> No events</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</section>
<section id="articleInfo">
    <div id="myArticles">
        <h1>My Articles</h1>
        <!-- INFO FROM DATABASE -->
        <div>
            <ul>
                <?php
                if (!empty($articles)) {
                    foreach ($articles as $article) {
                ?>
                        <li><?= $article['FillMeUp']; ?></li><br>
                <?php
                    }
                } else {
                    echo '<li> No articles</li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div id="myArticlesSuggestion">
        <h1>Suggestion</h1>
        <!-- INFO FROM DATABASE -->
        <div>
            <ul>
                <?php
                if (!empty($suggestionArticles)) {
                    foreach ($suggestionArticles as $suggestionArticle) {
                ?>
                        <li><?= $suggestionArticle['FillMeUp']; ?></li><br>
                <?php
                    }
                } else {
                    echo '<li> No articles</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>