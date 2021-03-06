<?php
$title = !isset($title) ? "Profile" : $title;
$style = '<link href="./public/css/profile.css" rel="stylesheet" />';
$avatarPath = './public/images/profile/allUsersProfilePics/file/' . $_SESSION['userId'];
ob_start();
?>
<div id="main-body">
    <section id="personnalInfo">
        <input hidden id="file" type="file" multiple>
        <div class="info-container" id="myInfos">
            <?php if (empty($infoProfile['premiumId'])) { ?>
                <a href="index.php?action=premium" class="card-btn">Go Premium</a>
            <?php
            }
            ?>
            <div id="avatar">
                <img class="profile-img" id="profile-img" src="<?= !empty($infoProfile['avatar']) ? "$avatarPath/{$infoProfile['avatar']}" : 'http://cdn.onlinewebfonts.com/svg/img_258083.png'; ?>" alt="profile image">
            </div>
            <div class = "boxUnderAvatar">
                <h1>Hi, <?= !empty($infoProfile) ? $infoProfile['userName'] : '...'; ?></h1>
                <?php if (!empty($infoProfile['premiumId'])) { ?>
                    <p id="premiumMessage">PREMIUM <strong><i class="fas fa-crown"></i></strong></p>
                <?php
                }
                ?>
            </div>
            <div>
                <p>FirstName : <span><?= !empty($infoProfile['firstName']) ? $infoProfile['firstName'] : '...'; ?></span></p>
                <p>LastName : <span><?= !empty($infoProfile['lastName']) ? $infoProfile['lastName'] : '...' ?></span></p>
                <p>Birthday : <span><?= !empty($infoProfile['birthDate']) ? $infoProfile['birthDate'] : '...'; ?></span></p>
                <p>Email : <span><?= !empty($infoProfile['email']) ? $infoProfile['email'] : '...' ?></span></p>
                <p>City : <span><?= !empty($infoProfile['city']) ? $infoProfile['city'] : '...' ?></span></p>

                <i id="editPersonnalInfos" class="far fa-edit fa-lg"></i>
            </div>
        </div>
        <div class="info-container" id="mySports">
            <h1>My Sports Interests</h1>
            <div>
                <ul id="mySportsList">
                    <?php
                    if (!empty($mySports)) :
                        foreach ($mySports as $sport) :
                    ?>
                            <li class="category">#<?= $sport['category_name']; ?></li><br>
                        <?php
                        endforeach;
                    else : ?>
                        <!-- <p> No sport added</p> -->
                    <?php endif; ?>
                </ul>
                <div id="sportSelect">
                    <select name="sportsCategories" id="sportsCategories">
                        <?php foreach ($categories as $category) : ?>
                            <option selected id="<?= $category['id']; ?>"><?= $category["name"]; ?></option>
                            <?php endforeach; ?>
                    </select>
                    <a id="addSport" class="card-btn" onclick="addMySport();">Add sport</a>
                </div>
            </div>

        </div>
    </section>
    <div id="changedInfo">
        <section id="eventInfo">
            <div class="info-container" id="myEvents">
                <h1>My Hosting Events</h1>
                <div class="list-event-cards">
                    <?php
                    if (!empty($hostingEvents)) {
                        $events = $hostingEvents;
                        $myHostingEventsChecker = true;
                        require('eventList.php');
                    } else {
                        echo '<p>No events added</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="info-container" id="myEvents">
                <h1>My Attending Events</h1>
                <div class="list-event-cards">
                    <?php
                    if (!empty($attendingEvents)) {
                        $events = $attendingEvents;
                        // $attending = true;
                        require('eventList.php');
                    } else {
                        echo '<p> No attending events</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="info-container" id="myEventSuggestions">
                <h1>Event Suggestions</h1>
                <div class="list-event-cards">
                    <?php
                    if (!empty($suggestionEvents)) {
                        $events = $suggestionEvents;
                        require('eventList.php');
                    } else {
                        echo '<p>No event suggestions. Please select some sports to fill the event suggestions.</p>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <section id="productInfo">
            <div class="info-container" id="myProducts">
                <h1>Wishlist Events</h1>
                <div class="list-event-cards">
                <?php
                    if (!empty($wishlist)) {
                        $events = $wishlist;
                        require('eventList.php');
                    } else {
                        echo '<p>No event suggestions. Please select some sports to fill the event suggestions.</p>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="./public/js/profile.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>