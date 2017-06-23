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
        <?php require 'html/form-log.html'; ?><!--add-form-->  
        <?php require 'html/add-scripts.html'; ?><!--add-scripts-->  
    </body>
</html>

<?php
$data = $_POST;
$errors = array();
if (isset($_SESSION['logged_user'])) {
    echo '<script>window.location.href = "profile.php";</script>';
} else {
//logowanie
    if (isset($data['logowanie'])) {
        if (trim($data['login']) == "")
            $errors[] = "Prosze wpisac login";
        if (trim($data['password']) == "")
            $errors[] = "Prosze wpisac haslo";
        if (empty($errors)) {
            $user = R::findOne('users', 'login=?', array($data['login']));
            if ($user) {
                if (password_verify($data['password'], $user->password)) {
                    $_SESSION['logged_user'] = $user;
                    //refresh
                    echo "<script type=\"text/javascript\">alert( \"Jestes zalogowany\");</script> \n";
                    echo '<script>window.location.reload();</script>';
                } else {
                    $errors[] = "Podane haslo jest niepoprawne. Prosze sprobowac ponownie";
                    echo '<h4 class="title text-center">' . array_shift($errors) . '</h4>';
                }
            } else {
                $errors[] = "Uzytkownika o podanym loginie nie istnieje";
                echo '<h4 class="title text-center">' . array_shift($errors) . '</h4>';
            }
        } else {
            echo '<h4 class="title text-center">' . array_shift($errors) . '</h4>';
        }
    }
//rejestracja
    if (isset($data['rejestracja'])) {
        if (trim($data['imie']) == "")
            $errors[] = "Prosze wpisac imie";
        if (trim($data['nazwisko']) == "")
            $errors[] = "Prosze wpisac nazwisko";
        if (trim($data['email']) == "")
            $errors[] = "Prosze wpisac email";
        if (trim($data['wiek']) == "")
            $errors[] = "Prosze wpisac wiek";
        if (trim($data['login_rejestracja']) == "")
            $errors[] = "Prosze wpisac login";
        if (trim($data['haslo1']) == "")
            $errors[] = "Prosze wpisac haslo";
        if (strlen(trim($data['haslo1'])) < 6)
            $errors[] = "Haslo musi zawierac co najmniej 6 znakow";
        if (trim($data['haslo2']) != $data['haslo1'])
            $errors[] = "Hasla nie pasuja";
        if (R::count('users', "email =?", array($data['email'])) > 0)
            $errors[] = "Uzytkownik o podanym adresie e-mail juz istnieje";
        if (R::count('users', "login =?", array($data['login_rejestracja'])) > 0)
            $errors[] = "Uzytkownik o podanym loginie juz istnieje";
        if (empty($errors)) {
            $user = R::dispense('users');
            $user->login = $data['login_rejestracja'];
            $user->password = password_hash($data['haslo1'], PASSWORD_DEFAULT);
            $user->imie = $data['imie'];
            $user->nazwisko = $data['nazwisko'];
            $user->email = $data['email'];
            $user->wiek = $data['wiek'];
            R::store($user);
            echo "<script type=\"text/javascript\">alert( \"Jestes zarejestrowany\");</script> \n";
           echo '<script>window.location.href = "profile.php";</script>';
        } else {
            echo '<h4 class="title text-center">' . array_shift($errors) . '</h4>';
        }
    }
    //new haslo
    if (isset($data['haslonon'])) {
        echo '<script>window.location.href = "newpassword.php";</script>';
    }
}
?>
