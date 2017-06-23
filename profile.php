<?php
require 'db.php';
$user = $_SESSION['logged_user'];
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
        <h2 class="title text-center">Twoj Profil</h2>
        <div class="col-sm-4 col-sm-offset-1">
            <div class="signup-form"><!--sign up form-->
                <h2>Edytowanie danych</h2>
                <form action="profile.php" method="POST">
                    Imie <input  type="text" name="imie" value ="<?php echo $user->imie; ?>"/>
                    Nazwisko<input  type="text" name="nazwisko"  value ="<?php echo $user->nazwisko; ?>"/>
                    Email <input  type="email" name="email"  value ="<?php echo $user->email; ?>"/>
                    Wiek<input  type="text" name="wiek" value ="<?php echo $user->wiek; ?>"/>
                    Login<input  type="text" name="login_edytowanie"  value ="<?php echo $user->login; ?>"/>
                    Haslo<input  type="password" name="haslo1"  placeholder="Nowe haslo"/>
                    Powtorz haslo<input  type="password" name="haslo2"  placeholder="Powtorz nowe haslo"/>
                    <button type="submit" name="edytowanie" value="edytowanie" class="btn btn-default">Edytuj</button>
                </form>
            </div><!--/sign up form-->
        </div>
        <div class="col-sm-4 col-sm-offset-1">
            <div class="signup-form"><!--sign up form-->
                <h2>Usuniecie konta</h2>
                <form action="profile.php" method="POST">
                    Haslo<input  type="password" name="haslousun"  placeholder="Prosze wpisac haslo"/>
                    <button type="submit" name="usuniecie" value="usuniecie" class="btn btn-default">Usun Konto</button>
                </form>
            </div><!--/sign up form-->
        </div>
        <?php require 'html/add-scripts.html'; ?><!--add-scripts-->  
    </body>
</html>
<?php
$data = $_POST;
$errors = array();
if (isset($_SESSION['logged_user'])) {
    if (isset($data['edytowanie'])) {
        $user->imie = $data['imie'];
        $user->nazwisko = $data['nazwisko'];
        $user->email = $data['email'];
        $user->wiek = $data['wiek'];
        if (R::count('users', "login =?", array($data['login_edytowanie'])) > 1) {
            $errors[] = "Uzytkownik o podanym loginie juz istnieje";
        } else {
            $user->login = $data['login_edytowanie'];
        }
        if (trim($data['haslo1']) != "") {
            $user->password = password_hash($data['haslo1'], PASSWORD_DEFAULT);
        }
        R::store($user);
        echo "<script type=\"text/javascript\">alert( \"Dane zostaly zmienione\");</script> \n";
    }

    if (isset($data['usuniecie'])) {
        if (trim($data['haslousun'] == ""))
            $errors[] = "Prosze wpisac haslo";
        if (empty($errors)) {
            if (password_verify($data['haslousun'], $user->password)) {
                R::trash($user);
                echo "<script type=\"text/javascript\">alert( \"Konto zostalo usuniete\");</script> \n";
                echo '<script>window.location.href = "logout.php";</script>';
            } else {
                $errors[] = "Bledne haslo";
                echo '<h4 class="title text-center">' . array_shift($errors) . '</h4>';
            }
        } else {
            echo '<h4 class="title text-center">' . array_shift($errors) . '</h4>';
        }
    }
} else {
    echo "<script type=\"text/javascript\">alert( \"Koszyk jest niedostepny.Musisz najpierw zalogowac sie\");</script> \n";
    echo '<script>window.location.href = "login.php";</script>';
}
?>