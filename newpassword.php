<?php require 'db.php'; ?>
<html lang="en">
    <head>
        <?php require 'html/head.html'; ?><!--add-head--> 
    </head>

    <body>
        <header id="header">
            <?php
            if (isset($_SESSION['logged_user'])) {
                require 'html/header-middle-top-reg.html';
            } else {
                require 'html/header-middle-top-noreg.html';
            }
            ?> <!--header-middle-->
            <?php require 'html/header-bottom.html'; ?><!--header-bottom-->
        </header><!--/header-->
        <?php require 'html/form-forget.html'; ?><!--add-form-->  
        <?php require 'html/add-scripts.html'; ?><!--add-scripts-->  
    </body>
</html>

<?php
$data = $_POST;
$errors = array();
if (isset($_SESSION['logged_user'])) {
    echo '<script>window.location.href = "profile.php";</script>';
} else {
//regeneracja hasla
    if (isset($data['logowanie'])) {
        if (trim($data['login']) == "")
            $errors[] = "Prosze wpisac login";
        if (empty($errors)) {
            $user = R::findOne('users', 'login=?', array($data['login']));
            if ($user) {
                $newpass = preg_replace("/./e", "chr(rand(ord('a'),ord('z')))", "12345678");
                echo "<script type=\"text/javascript\">alert( \"Nowe haslo : $newpass\");</script> \n";
                //echo $newpass;
                //mail($user->email, 'Nowe haslo', $newpass, 'From:'.'bovttt@gmail.com');
                $user->password = password_hash($newpass, PASSWORD_DEFAULT);
                R::store($user);
                echo '<script>window.location.href = "login.php";</script>';
            } else {
                $errors[] = "Uzytkownika o podanym loginie nie istnieje";
                echo '<h4 class="title text-center">' . array_shift($errors) . '</h4>';
            }
        } else {
            echo '<h4 class="title text-center">' . array_shift($errors) . '</h4>';
        }
    }
}
?>
