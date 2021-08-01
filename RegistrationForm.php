<?php
error_reporting(-1);
session_start();
require_once 'connect_db.php';

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

if (isset($_POST['submit'])){

    if ($_POST['year'] < date('Y') - 150 )
    {
        $_SESSION['message'] = 'To Old!';
        header('Location: RegistrationForm.php');
        exit();

    } elseif ($_POST['year'] > date('Y') - 5) {

        $_SESSION['message'] = 'To yang';
        header('Location: RegistrationForm.php');
        exit();

    } else {
        $login = $_POST['login'];
        $password = sha1($_POST['password']);
        $birth = $_POST['year'].'-'.$_POST['mounth'].'-'.$_POST['day'];


        $query = "SELECT BINARY login FROM users_4sk WHERE BINARY login='$login' LIMIT 1";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result)) {
            $_SESSION['message'] = 'Логин занят';
            header('Location: RegistrationForm.php');
            exit();
        } else {
            $query = "INSERT INTO users_4sk(login,password,birth) VALUES ('$login' , '$password' , '$birth')";
            $result = mysqli_query($connect,$query);
            $_SESSION['login'] = $login; //при реги записываем в сессию логин
            header("Location: count.php");
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
    <title>Document</title>
</head>
<body>

<form action="" name="registration" method="post">

    <p>
       Логин: <input type="text" name="login" required>
    </p>

    <p>
       Пароль: <input type="password" name="password" required>
    </p>

    <p>
        Дата рождения:
        <?php
            echo "<select name='year'>";
            for ($year = date('Y') - 170; $year <= date('Y'); $year++)
            {
                echo "<option value='$year'>$year</option>";
            }
            echo "</select>";


            echo "<select name='mounth'>";
            for($mounth=1;$mounth<=12;$mounth++)
            {
                echo "<option  value='$mounth'>$mounth</option>";
            }
            echo "</select>";


            echo "<select name='day'>";
            for($day=1;$day<=31;$day++)
            {
                echo "<option  value='$day'>$day</option>";
            }
            echo "</select>";
        ?>
    </p>

    <input type="submit" name="submit" value="Регистрация" >
</form>

</body>
</html>

