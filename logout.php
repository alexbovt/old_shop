<?php

require 'db.php';
if (isset($_SESSION['logged_user'])) {
    unset($_SESSION['logged_user']);
    echo "<script type=\"text/javascript\">alert( \"Zostal wylogowany\");</script> \n";
} else {
    echo "<script type=\"text/javascript\">alert( \"Koszyk jest niedostepny.Musisz najpierw zalogowac sie\");</script> \n";
    echo '<script>window.location.href = "index.php";</script>';
}
echo '<script>window.location.href = "index.php";</script>';
?>