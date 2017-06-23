<?php
require 'db.php';
?>
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
        <div class="col-sm-4 col-sm-offset-1">
            <div class="signup-form"><!--sign up form-->
                <h2>Zostal komentarz</h2>
                <form action="contact.php" method="POST">
                    <input  type="text" name="text"  placeholder="Twoj komentarz"/>
                    <button type="submit" name="wyslij" value="wysylka" class="btn btn-default">Wyslij</button>
                </form>
            </div><!--/sign up form-->
        </div>
        <div class="col-sm-4 col-sm-offset-1">
            <div class="signup-form"><!--sign up form-->
                <h2>Kontakty</h2>
                <form>
                    <h2>Ulica: Nadbystrzycka 44a</h2>
                    <h2>Telefon: 999-999-99</h2>
                    <h2>Poczta: sklep@mail.com</h2>
                </form>
            </div><!--/sign up form-->
        </div>
        <?php require 'html/add-scripts.html'; ?><!--add-scripts-->  
    </body>
</html>
<?php
$data = $_POST;
$errors = array();

if (isset($data['wyslij'])) {
    if (isset($_SESSION['logged_user'])) {
        $user = $_SESSION['logged_user'];
        $header = 'Od' . $user->email;
        if (trim($data['text']) == "")
            $errors[] = "Prosze wpisac komentarz";
        if (empty($errors)) {
            mail('sklep@mail.com', 'Komentarz', $text, $header);
        } else {
            echo '<h4 class="title text-center">' . array_shift($errors) . '</h4>';
        }
    } else
        echo "<script type=\"text/javascript\">alert( \"Musis najpierw zalogowac sie\");</script> \n";
}
?>