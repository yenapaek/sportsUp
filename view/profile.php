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
            <!-- #TODO user must be able to upload an avatar when creating a profile -->
            <div id="avatarDiv">
                <img class="profile-img" id="profile-img" src="<?= !empty($infoProfile['avatar']) ? "$avatarPath/{$infoProfile['avatar']}" : 'http://cdn.onlinewebfonts.com/svg/img_258083.png'; ?>" alt="profile image">
            </div>
            <div>
                <h1>Hi, <?= !empty($infoProfile) ? $infoProfile['userName'] : '...'; ?></h1>
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
            <div class="titleEdit">
                <h1>My Interests</h1>
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
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>
    <div id="changedInfo">
        <section id="eventInfo">
            <div class="info-container" id="myEvents">
                <h1>Events</h1>
                <div class="titleEdit">
                    <h2>My Events</h2>
                    <button>Create Event</button>
                    <!-- INFO FROM DATABASE -->
                </div>
                <div id="list-event-cards">
                    <div class="event-card">
                        <img src="https://images.unsplash.com/photo-1607417307790-5f3efc48ced3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80" alt="">
                        <div>
                            <div class="card-datetime">
                                <i class="far fa-clock"></i>
                                <span>Tues, May 11 @17:00</span>
                            </div>
                            <div class="card-title"><span>Football Game in the Park</span></div>
                            <div class="card-description"><span>Fun football game for all levels</span></div>
                            <div>
                                <i class="far fa-edit"></i>
                                <i class="far fa-trash-alt"></i>
                            </div>
                            <!-- <div class="card-location">                            
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Seoul</span>
                            </div> -->
                            <!-- <div class="card-btn"><span>View Details</span></div> -->
                        </div>
                    </div>
                    <div class="event-card">
                        <img src="https://images.unsplash.com/photo-1607417307790-5f3efc48ced3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80" alt="">
                        <div class="event-detail">
                            <div class="card-datetime">
                                <i class="far fa-clock"></i>
                                <span>Tues, May 11 @17:00</span>
                            </div>
                            <div>
                                <i class="far fa-calendar"></i>
                                <span class="card-title">Football Game in the Park</span>
                            </div>
                            <div class="card-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Seoul</span>
                            </div>
                            <div>
                                <i class="far fa-edit"></i>
                                <i class="far fa-trash-alt"></i>
                            </div>
                            <!-- <div class="card-description"><span>Fun football game for all levels</span></div> -->
                            <!-- <div class="card-btn"><span>View Details</span></div> -->
                        </div>
                    </div>
                    <div class="event-card">
                        <img src="https://images.unsplash.com/photo-1607417307790-5f3efc48ced3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80" alt="">
                        <div>
                            <div class="card-datetime">
                                <i class="far fa-clock"></i>
                                <span>Tues, May 11 @17:00</span>
                            </div>
                            <div class="card-title"><span>Football Game in the Park</span></div>
                            <div class="card-description"><span>Fun football game for all levels</span></div>
                            <div>
                                <i class="far fa-edit"></i>
                                <i class="far fa-trash-alt"></i>
                            </div>
                            <!-- <div class="card-location">                            
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Seoul</span>
                            </div> -->
                            <!-- <div class="card-btn"><span>View Details</span></div> -->
                        </div>
                    </div>
                    <div class="event-card">
                        <img src="https://images.unsplash.com/photo-1607417307790-5f3efc48ced3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80" alt="">
                        <div>
                            <div class="card-datetime">
                                <i class="far fa-clock"></i>
                                <span>Tues, May 11 @17:00</span>
                            </div>
                            <div class="card-title"><span>Football Game in the Park</span></div>
                            <div class="card-description"><span>Fun football game for all levels</span></div>
                            <div>
                                <i class="far fa-edit"></i>
                                <i class="far fa-trash-alt"></i>
                            </div>
                            <!-- <div class="card-location">                            
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Seoul</span>
                            </div> -->
                            <!-- <div class="card-btn"><span>View Details</span></div> -->
                        </div>
                    </div>
                </div>
                <div>
                    <ul>
                        <?php
                        if (!empty($myEvents)) {
                            foreach ($myEvents as $event) {
                        ?>
                                <?php
                                #TODO create an event creater function that saves db data into an array
                                // print_r($event);
                                // echo $event['name'];
                                // echo $event['picture'];
                                // echo $event['eventDate'];

                                ?>
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
                            foreach ($attendingEvents as $attendingEvent) {
                        ?>
                                <li><?= $attendingEvent['FillMeUp']; ?></li><br>
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
<script src="./public/js/profile.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>