<?php
session_start(); // Убедитесь, что сессия запускается в начале

$url = trim($_SERVER['REQUEST_URI'], '/');
if ($url == 'career_service/exit') {
    session_unset(); // Очищаем данные сессии
    session_destroy(); // Уничтожаем сессию
    header('Location: /career_service'); // Редирект на главную страницу
    exit(); 
}

// Подключаем базу данных
$host = "localhost";
$user = "root";
$password = "";
$database = "career_service"; 

$link = mysqli_connect($host, $user, $password, $database);

// Получаем URL
$url = trim($_SERVER['REQUEST_URI'], '/'); 
$url_parts = explode('/', $url);  // Разбиваем URL на части

// Проверяем, что массив имеет необходимое количество элементов
if (isset($url_parts[0]) && $url_parts[0] === 'career_service') {
    if (isset($url_parts[1]) && $url_parts[1] === 'profile' && isset($url_parts[2]) && is_numeric($url_parts[2])) {
        $_GET['id'] = $url_parts[2]; 
        include('public/profile.php');
    } elseif (isset($url_parts[1]) && $url_parts[1] === 'test' && isset($url_parts[2]) && is_numeric($url_parts[2])) { 
        // Если путь правильный, передаем ID теста
        $_GET['id'] = $url_parts[2];  
        include('public/test.php');
    } elseif (isset($url_parts[1]) && $url_parts[1] === 'submit_test' && isset($url_parts[2]) && is_numeric($url_parts[2])) { 
        // Обрабатываем отправку теста
        $_GET['id'] = $url_parts[2];  
        include('public/submit_test.php');
    } else {
        // Иначе показываем главную страницу
        include('public/index.php');
    }
} else {
    include('public/index.php');
}
?>
