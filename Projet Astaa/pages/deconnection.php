<?php
    SESSION_START();

    SESSION_destroy();
    header('Location: index.php');
?>