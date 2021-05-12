<?php
    #TODO make a template to fill other sections - my events/attending events

    if (!empty($suggestionEvents)) {
        foreach ($suggestionEvents as $suggestionEvent): ?>
            <div class="event-card">
            <!-- #TODO change later to accept event category images -->
                <div class="card-img" style="background-image: url('<?= !empty($suggestionEvent['picture']) ? $suggestionEvent['picture'] : '...'; ?>')"></div>
                <div class="event-detail">
                <!-- #TODO change the datetime to a user friendly date format -->
                    <div class="card-datetime">
                        <i class="far fa-clock"></i>
                        <span><?= !empty($suggestionEvent['eventDate']) ? $suggestionEvent['eventDate'] : '...'; ?></span>
                    </div>
                    <div class="card-location">                            
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Seoul</span>
                    </div>
                    <div>
                        <i class="far fa-calendar"></i>
                        <span class="card-title"><?= !empty($suggestionEvent['name']) ? $suggestionEvent['name'] : '...'; ?></span>
                    </div>
                    <div class="card-description">
                        <span><?= !empty($suggestionEvent['description']) ? $suggestionEvent['description'] : '...'; ?></span>
                    </div>
                    <!-- <div class="btn">
                        <span>View Details</span>
                    </div> -->
                </div>
            </div>
        <?php endforeach;
    }