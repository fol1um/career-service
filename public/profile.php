<?php include('header.php'); ?>

<div class="container"> 
<h1>Добро пожаловать, 
    <?php
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($link, $sql);
    $user = mysqli_fetch_assoc($result);
    echo htmlspecialchars($user['full_name']);
    ?>!</h1>

    <h2>Ваши результаты:</h2>
    <table>
        <tr>
            <th>Тест</th>
            <th>Дата</th>
            <th>Оценка</th>
        </tr>
        <?php
        $test_results_sql = "SELECT tr.*, t.title FROM TestResults tr 
                             JOIN Tests t ON tr.test_id = t.id 
                             WHERE tr.user_id = '$user_id'";
        $test_results = mysqli_query($link, $test_results_sql);
        while ($row = mysqli_fetch_assoc($test_results)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['date_completed']); ?></td>
                <td><?php echo htmlspecialchars($row['total_score']); ?></td>
            </tr>
        <?php } ?>
    </table>

    <h3>Доступные тесты:</h3>
    <?php
    $available_tests_sql = "SELECT * FROM Tests";
    $available_tests = mysqli_query($link, $available_tests_sql);
    while ($row = mysqli_fetch_assoc($available_tests)) {
        echo '<a href="/career_service/test/' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a><br>';
    }
    ?>
</div>   
</body>
</html>
