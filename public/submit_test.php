<?php

include('header.php'); 

// Проверяем, есть ли user_id в сессии
if (!isset($_SESSION['id'])) {
    die("Ошибка: пользователь не авторизован.");
}

$user_id = $_SESSION['id']; 

// Получаем ID теста
if (!isset($_GET['id'])) {
    die("Ошибка: ID теста не передан.");
}

$test_id = $_GET['id'];

// Подключаем базу данных
$host = "localhost";
$user = "root";
$password = "";
$database = "career_service"; 
$link = mysqli_connect($host, $user, $password, $database);

// Получаем вопросы для теста
$sql_questions = "SELECT * FROM Questions WHERE test_id = $test_id";
$questions_result = mysqli_query($link, $sql_questions);
$questions = mysqli_fetch_all($questions_result, MYSQLI_ASSOC);

// Проверка на наличие вопросов
if (empty($questions)) {
    die("Ошибка: Вопросы для теста не найдены.");
}

// Переменная для хранения итогового балла (не используется)
$total_score = 0;

// Обрабатываем ответы
foreach ($questions as $question) {
    $question_id = $question['id'];

    if (isset($_POST["question_$question_id"])) {
        $answer_id = $_POST["question_$question_id"];

        // Получаем ответ на вопрос
        $sql_answer = "SELECT * FROM Answers WHERE id = $answer_id";
        $answer_result = mysqli_query($link, $sql_answer);
        
        if ($answer_result) {
            $answer = mysqli_fetch_assoc($answer_result);

            // Здесь можно делать дополнительные действия с ответами (например, сохранять их в базе)
        } else {
            echo "Ошибка: Ответ с ID $answer_id не найден.";
            exit();
        }
    }
}

// Вставляем результат в базу данных (сейчас без баллов)
$sql_insert_result = "INSERT INTO TestResults (user_id, test_id, date_completed) 
                      VALUES ($user_id, $test_id, NOW())";

if (mysqli_query($link, $sql_insert_result)) {
    // Редирект на страницу с результатами или благодарность
    header("Location: /career_service/test_results/$test_id");
    exit();
} else {
    die("Ошибка при записи в базу данных: " . mysqli_error($link));
}
?>
