<?php
session_start();
require_once 'connect_db.php';

echo 'Привет '. $_SESSION['login'];

if (isset($_SESSION['login']))
{
    $login = $_SESSION['login'];

    $query = "SELECT count,login FROM users_4sk WHERE login = '$login' ";
    $result = mysqli_query($connect,$query) or die(mysqli_error($connect));

    while($row = mysqli_fetch_array($result)) {
        //$_SESSION['count'] ? 1 : $row['count'];

        if(!isset($_SESSION['count']))
        {
            $_SESSION['count'] = 0;
        } else {
            $_SESSION['count'] = $row['count'];
        }

        if(isset($_POST['count'])){

            $count = ++$_SESSION['count'];
            $query = "UPDATE users_4sk SET count = '{$_SESSION['count']}' WHERE login = '$login' ";
            mysqli_query($connect, $query);
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

        <form class="modal" action="" name="count" method="post">
            <p><h1><?= $_SESSION['count'] ?></h1></p>

            <p>
                <button name="count" type="submit" value="<?= $_SESSION['count'] ?>"> +1 </button>

                <a href= "logout.php" class="button">Выход</a>
            </p>
        </form>

</body>
</html>
