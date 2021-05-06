<?php

require("./controller/controller.php");
require("./controller/eventsController.php");
try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
    switch ($action) {
        case "landing":
            // landing();
            break;
        case "events":
            categoriesInfo();
            break;

        case "searchSubmit":
            if (isset($_REQUEST['searchEvent'])) {
                eventsSearchInput($_REQUEST['searchEvent']);
            } elseif (isset($_REQUEST['sportCriteria'])) {
                eventsSearchSelect($_REQUEST['sportCriteria']);
            }
            break;

        default:
        // landing();
            break;
    }
}
catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    $file = $e->getFile();
    $line = $e->getLine();
    // require('./view/error.php');
}
