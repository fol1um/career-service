<?php 
if (!isset($_GET['id'])) {
    die("Ошибка: ID теста не передан.");
}

$test_id = $_GET['id'];


// Получаем информацию о тесте
$sql = "SELECT * FROM Tests WHERE id = $test_id";
$result = mysqli_query($link, $sql);
$test = mysqli_fetch_assoc($result);

if ($test) {
    $test_title = $test['title'];
    $test_description = $test['description'];
} else {
    die("Тест не найден.");
}

// Получаем вопросы для теста
$sql_questions = "SELECT * FROM Questions WHERE test_id = $test_id";
$questions_result = mysqli_query($link, $sql_questions);
$questions = mysqli_fetch_all($questions_result, MYSQLI_ASSOC);

include('header.php'); 
?>

<div class="intro">
    <div class="container">
        <h1><?php echo htmlspecialchars($test_title); ?></h1>
        <div class="intro_description"><?php echo nl2br(htmlspecialchars($test_description)); ?></div>
        <div class="intro_data">
            <div class="intro_data_quantity"><?php echo count($questions); ?> вопросов</div>
            <div class="intro_data_quantity">≈ 15 минут</div>
        </div>
    </div>
</div>

<form action="/career_service/submit_test/<?php echo $test_id; ?>" method="POST">
    <div class="questions">
    <div class="container">
        <?php
        foreach ($questions as $question) {
            $question_text = htmlspecialchars($question['text']);
            $question_id = $question['id'];

            echo "<div class='question'>";
            echo "<h2>$question_text</h2>";

            // Получаем ответы на вопрос
            $sql_answers = "SELECT * FROM Answers WHERE question_id = $question_id";
            $answers_result = mysqli_query($link, $sql_answers);
            $answers = mysqli_fetch_all($answers_result, MYSQLI_ASSOC);

            echo "<ul>";
            foreach ($answers as $answer) {
                $answer_text = htmlspecialchars($answer['answer_text']);
                $answer_value = $answer['id'];
                echo "<li><input type='radio' name='question_$question_id' value='$answer_value' id='answer_$answer_value'> <label for='answer_$answer_value'>$answer_text</label></li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>
    
    

    <button type="submit" class="intro_button">Отправить ответы</button>
    </div>
    </div>
</form>


<?php include('footer.php'); ?>
