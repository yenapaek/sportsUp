<?php
    $title = !isset($title) ? "Profile" : $title;
    $style = '<link href="./public/css/profile.css" rel="stylesheet" />';
    ob_start();
?>
<div id="main-body">
    <section id="personnalInfo">
        <div class="info-container" id="myInfos">
            <!-- #TODO user must be able to upload an avatar when creating a profile -->
            <div id="avatar">
                <img src="<?= !empty($infoProfile['avatar']) ? $infoProfile['avatar'] : 'http://cdn.onlinewebfonts.com/svg/img_258083.png'; ?>" alt="profile image" class="profile-img">
            </div>
            <div>
                <h1>Hi, <?= !empty($infoProfile) ? $infoProfile['userName'] : '...'; ?></h1>
            </div>
            <div>
                <p>First Name: <?= !empty($infoProfile['firstName']) ? $infoProfile['firstName'] : '...'; ?></p>
                <p>Last Name: <?= !empty($infoProfile['lastName']) ? $infoProfile['lastName'] : '...' ?></p>
                <p>Birthday: <?= !empty($infoProfile['birthDate']) ? $infoProfile['birthDate'] : '...'; ?></p>
                <p>Email: <?= !empty($infoProfile['email']) ? $infoProfile['email'] : '...' ?></p>
                <p>City: <?= !empty($infoProfile['city']) ? $infoProfile['city'] : '...' ?></p>
            </div>
        </div>
        <div class="info-container" id="mySports">
            <h1>My Sports</h1>
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
                        <li class="category"> No sport added</li>
                    <?php endif;?>
                </ul>
                <div id="sportSelect">
                    <select name="sportsCategories" id="sportsCategories">
                        <option value="default" selected disabled>Select Your Sport</option>
                        <?php foreach ($categories as $category) : ?>
                            <option id="<?= $category['id']; ?>"><?= $category["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="button" name="addSport" id="addSport" onclick="addMySport();" value="Add Sport">
                </div>
            </div>
            
        </div>
    </section>
    <div id="changedInfo">
        <section id="eventInfo">
            <div class="info-container" id="myEvents">
                <h1>My Events</h1>
                <div class="list-event-cards">
                    <?php require('myEventsShort.php') ?>
                </div>
                <div class="divider"></div>
                <h1>Attending Events</h1>
                <div class="list-event-cards">
                <!-- #TODO add attending events function -->
                    <?php require('myAttendingEventsShort.php') ?>
                </div>
            </div>
            <div class="info-container" id="myEventSuggestions">
                <h1>Event Suggestions</h1>
                <div class="list-event-cards">
                    <?php require('mySuggestionEventsShort.php') ?>
                </div>
            </div>
        </section>
        <section id="productInfo">
            <div class="info-container" id="myProducts">
                <h1>My Products</h1>
                <!-- INFO FROM DATABASE -->
                <div>
                    <ul>
                        <?php
                        if (!empty($products)) {
                            foreach ($products as $product) {
                        ?>
                                <li><?= $product['FillMeUp']; ?></li><br>
                        <?php
                            }
                        } else {
                            echo '<div> No products</div>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="info-container" id="myProductSuggestions">
                <h1>Product Suggestions</h1>
                <!-- INFO FROM DATABASE -->
                <div>
                    <ul>
                        <?php
                        if (!empty($suggestionProducts)) {
                            foreach ($suggestionProducts as $suggestionProduct) {
                        ?>
                                <li><?= $suggestionProduct['FillMeUp']; ?></li><br>
                        <?php
                            }
                        } else {
                            echo '<div> No products</div>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="./public/js/profileUpdate.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>