 <?php
    if (!empty($eventMessage)) {
        foreach ($eventMessage as $message) {
    ?>
         <div class="messageBox">
             <div>
                 <input class="commentIdDel" type="hidden" name="commentIdDel" value="<?= $message['id'] ?>">
                 <input class="eventIdDel" type="hidden" name="eventIdDel" value="<?= $event['eventId'] ?>">

                 <h4><?= ucfirst(htmlspecialchars($message['userName'])) ?> : <?= htmlspecialchars(date('m/d/y  g:i a', strtotime($message['messageDate']))) ?></h4>
                 <?php
                    if ($message['userId'] === $_SESSION['userId']) {
                    ?>
                     <i class="far fa-trash-alt deleteComment"></i>
                 <?php
                    }
                    ?>
             </div>
             <p><?= htmlspecialchars($message['message']) ?></p>
         </div>
 <?php
        }
    }
    ?>