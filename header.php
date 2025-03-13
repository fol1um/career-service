<?php

if ((isset($_POST['email'])) && (isset($_POST['pass'])) && (isset($_POST['name'])) && (isset($_POST['birth_date']))) {
    $email = $_POST['email'];
    $password_hash = $_POST['pass'];
    $full_name = $_POST['name'];
    $birth_date = $_POST['birth_date'];

    $role_id = 2; 
    $sql = "INSERT INTO `users`(`email`, `password_hash`, `full_name`, `birth_date`, `role_id`) 
            VALUES ('$email', '$password_hash', '$full_name', '$birth_date', '$role_id')";

    mysqli_query($link, $sql);

}

// Обработка авторизации
elseif ((isset($_POST['email'])) && (isset($_POST['pass']))) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    $sql = "SELECT * FROM users WHERE email='$email' AND password_hash='$pass'"; 
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_assoc($result)) { 
        $_SESSION["id"] = $row['id'];
        $_SESSION["email"] = $row['email']; 
    }

}
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/career_service/assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Профориентация</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header_top">
                <a href="mailto:alesviatkin@gmail.com" class="b-icons b-icons_mail"><i></i>alesviatkin@gmail.com</a>
                <div class="header_top_r">
                    <a href="tel:+375257524377" class="b-icons b-icons_main"><i></i>+375 25 752-43-77</a>
                    <div class="b-icons b-icons_">пн-пт 09:00-18:00</div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="header_logo"><a href="/career_service">Профориентация</a></div>
                <nav class="nav">
                    <a class="nav_link" href="#">Тесты</a>
                    <a class="nav_link" href="#">Профессии</a>
                    <a class="nav_link" href="#">О нас</a>
                    <a class="nav_link" href="#">Статьи</a>
                    <a class="nav_link" href="#">Контакты</a>
                </nav>
                <div class="button_header">
                <?php
                    if (isset($_SESSION['id'])) { // Если сессия активна (пользователь авторизован)
                ?>
                    <a href="/career_service/profile/<?php echo $_SESSION['id']; ?>">
                        <button class="lk-button">Профиль</button>
                    </a>
                    <a href="/career_service/exit">
                        <button class="lk-button">Выйти</button>
                    </a>
                <?php } else { // Если пользователь не авторизован ?>
                    <button onclick="openPopup('loginPopup')" class="lk-button">Личный кабинет</button>
                <?php } ?>
                </div>
                
            </div>
    </header>