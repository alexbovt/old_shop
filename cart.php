<?php require 'db.php'; ?>
<html lang="en">
    <head>
        <?php require 'html/head.html'; ?><!--add-head--> 
    </head>

    <body>
        <?php
        if (isset($_SESSION['logged_user'])) {
            require 'html/header-middle-top-reg.html';
        } else {
            require 'html/header-middle-top-noreg.html';
        }
        ?> <!--header-middle-->
        <?php require 'html/header-bottom.html'; ?><!--header-bottom-->
    </header><!--/header-->

    <?php require 'html/cart-items.html'; ?><!--/#cart_items-->

    <?php require 'html/add-scripts.html'; ?><!--add-scripts-->  
</body>
</html>
<?php
if (isset($_SESSION['logged_user'])) {
    
} else {
    echo "<script type=\"text/javascript\">alert( \"Koszyk jest niedostepny.Musisz najpierw zalogowac sie\");</script> \n";
    echo '<script>window.location.href = "login.php";</script>';
}
?>