<?php
session_start();
error_reporting(-1);
require_once 'connect_db.php';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];;
    unset($_SESSION['message']);
}

if(isset($_POST['submit'])){

    if (isset($_POST['login']) && (isset($_POST['password'])) ) {

        $login = $_POST['login'];
        $password = sha1($_POST['password']);

        //BINARY - следующие за ним строки будут регистрозависимые
        $query = "SELECT * FROM users_4sk WHERE BINARY login = '$login' and BINARY password = '$password'";
        $_SESSION['count'] = $query['count'];


        $result = mysqli_query($connect,$query) or die(mysqli_error($connect));

        //число из результатов выборки
        $count = mysqli_num_rows($result);

        if($count == true) {
            $_SESSION['login'] = $_POST['login'];
            header('Location: count.php');
        } else {

           $_SESSION['message'] = 'неправильный логин или пароль';
            header('Location: Login.php');
        }
    }

}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="style.css" type="text/css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>

<div class="parent">
        <div class="block">
            <?= $message ?>
        </div>
</div>

<form class="modal" action="" name="login" method="post">
    <p>
        Логин : <input type="text" name="login">
    </p>

    <p>
        Пароль : <input type="password" name="password">
    </p>

    <p>
        <input class="button" type="submit" name="submit" value="Войти">

        <a href="RegistrationForm.php" class="button">Регистрация</a>
    </p>
</form>

</body>
</html>

