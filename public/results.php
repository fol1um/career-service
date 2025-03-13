<?php
session_start();
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["test_id"])) {
    die("Некорректный запрос.");
}

$test_id = $_POST["test_id"];
$user_id = $_SESSION["user_id"] ?? null;

if (!$user_id) {
    header("Location: login.php");
    exit;
}

$questions = $_POST["questions"];
$answers = $_POST["answers"];

// Подсчет баллов по тесту
$score = 0;
foreach ($questions as $question_id) {
    $answer_id = $answers[$question_id] ?? null;
    if ($answer_id) {
        $stmt = $pdo->prepare("SELECT score FROM Answers WHERE id = ?");
        $stmt->execute([$answer_id]);
        $answer_score = $stmt->fetchColumn();
        $score += $answer_score;
    }
}

// Определение профессии по результатам теста
$stmt = $pdo->prepare("SELECT * FROM Professions WHERE min_score <= ? ORDER BY min_score DESC LIMIT 1");
$stmt->execute([$score]);
$profession = $stmt->fetch(PDO::FETCH_ASSOC);

// Сохранение результата в БД
$stmt = $pdo->prepare("INSERT INTO Results (user_id, test_id, score, profession_id) VALUES (?, ?, ?, ?)");
$stmt->execute([$user_id, $test_id, $score, $profession["id"] ?? null]);

?>

<h1>Результаты теста</h1>
<p>Ваш набранный балл: <strong><?= $score ?></strong></p>

<?php if ($profession): ?>
    <p>Рекомендуемая профессия: <strong><?= htmlspecialchars($profession["name"]) ?></strong></p>
    <p><?= htmlspecialchars($profession["description"]) ?></p>
<?php else: ?>
    <p>Не удалось определить подходящую профессию.</p>
<?php endif; ?>

<a href="index.php">Вернуться на главную</a>
