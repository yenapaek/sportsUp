<?php
    $title = !isset($title) ? "Profile" : $title;
    $style = '<link href="./public/css/profile.css" rel="stylesheet" />';
    ob_start();
?>
<div id="main-body">
    <section id="personnalInfo">
        <div class="info-container" id="myInfos">
            <div>
                <img src="./public/images/aboutUs/Alexis.png" alt="profile image" class="profile-img">
            </div>
            <div>
                <h1>Hi, <?= !empty($infoProfil) ? $infoProfil['userName'] : '...'; ?></h1>
            </div>
            <div>
                <!-- <p>UserName : <?= !empty($infoProfil) ? $infoProfil['userName'] : '...'; ?></p> -->
                <p>FirstName : <?= !empty($infoProfil['firstName']) ? $infoProfil['firstName'] : '...'; ?></p>
                <p>LastName : <?= !empty($infoProfil['lastName']) ? $infoProfil['lastName'] : '...' ?></p>
                <p>Birthday : <?= !empty($infoProfil['birthDate']) ? $infoProfil['birthDate'] : '...'; ?></p>
                <p>Email : <?= !empty($infoProfil['email']) ? $infoProfil['email'] : '...' ?></p>
                <p>Nationality : <?= !empty($infoProfil['nationality']) ? $infoProfil['nationality'] : '...' ?></p>
                <p>City : <?= !empty($infoProfil['city']) ? $infoProfil['city'] : '...' ?></p>
            </div>
        </div>

        <div class="info-container" id="mySports">
            <div class="titleEdit">
                <h1>My sport</h1>
                <button>Add Sport</button>
            </div>
            <div>
                <ul>
                    <?php
                    if (!empty($mySports)) :
                        foreach ($mySports as $sport) :
                    ?>
                            <li><?= $sport['category_name']; ?></li><br>
                    <?php
                        endforeach;
                    else : ?>
                        <li> No sport added</li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </section>
    <div id="changedInfo">
        <section id="eventInfo">
            <div class="info-container" id="myEvents">
                <h1>My Events</h1>
                <div class="titleEdit">
                    <h2>Created</h2>
                    <button>Create Event</button>
                    <!-- INFO FROM DATABASE -->
                </div>
                <div class="event-card">
                    <img src="https://images.unsplash.com/photo-1607417307790-5f3efc48ced3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80" alt="">
                    <div>
                        <div class="card-datetime"><i class="far fa-clock"></i>
                        <span>Tues, May 11 @17:00</span>
                        </div>
                        <p class="card-title">Football Game in the Park</p>
                        <p class="card-description">Fun football game for all levels</p>
                        <p class="card-btn">View Details</p>
                    </div>

                </div>
                <div>
                    <ul>
                        <?php
                        if (!empty($myEvents)) {
                            foreach ($myEvents as $event) {
                        ?>
                                <li>
                                    <?= 
                                        #TODO create an event creater function that saves db data into an array
                                        $event;
                                    ?>
                                </li><br>

                        <?php
                            }
                        } else {
                            echo '<li> No events</li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="titleEdit">
                    <h2>Attending</h2>
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

            <div class="info-container" id="myEventSuggestions">
                <h1>Event Suggestions</h1>
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
                            echo '<li> No products</li>';
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
                            echo '<li> No products</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>