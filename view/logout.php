<?php
session_start();
session_destroy();
header("Location: index.php?action=landing");
// header("Location: index.php?action=signIn");
