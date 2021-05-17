<?php
    #TODO make a template to fill other sections - my events/attending events

    if (!empty($myEvents)) {
        foreach ($myEvents as $event): ?>
            <div class="event-card">
            <!-- #TODO change later to accept event category images -->
                <div class="card-img" style="background-image: url('<?= !empty($event['picture']) ? $event['picture'] : '...'; ?>')"></div>
                <div class="event-detail">
                <!-- #TODO change the datetime to a user friendly date format -->
                    <div class="card-datetime">
                        <i class="far fa-clock"></i>
                        <span><?= !empty($event['eventDate']) ? $event['eventDate'] : '...'; ?></span>
                    </div>
                    <div class="card-location">                            
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Seoul</span>
                    </div>
                    <div>
                        <i class="far fa-calendar"></i>
                        <span class="card-title"><?= !empty($event['name']) ? $event['name'] : '...'; ?></span>
                    </div>
                    <div class="card-description">
                        <span><?= !empty($event['description']) ? $event['description'] : '...'; ?></span>
                    </div>
                    <div>
                    <a href="index.php?action=editEvent"><i class="far fa-edit"></i></a>
                        <i class="far fa-trash-alt"></i>
                    </div>
                </div>
            </div>
        <?php endforeach;
    }