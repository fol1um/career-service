<?php include('header.php'); ?>



<div class="intro">
        <div class="container">
            <h1>Выберите свою профессию с уверенностью!</h1>
            <div class="intro_description">Наш сервис поможет вам найти карьерный путь, который соответствует твоим интересам и сильным сторонам.</div>
            <div class="advantages">
                <div class="advantages_container">
                    <img src="assets/images/chek.png" alt="">
                    <p>Государственная лицензия</p>
                </div>
                <div class="advantages_container">
                    <img src="assets/images/chek.png" alt="">
                    <p>5 тестов</p>
                </div>
                <div class="advantages_container">
                    <img src="assets/images/chek.png" alt="">
                    <p>Только актуальные данные</p>
                </div>
            </div>
            <button class="intro_button">Выбрать тест</button>
        </div>
</div>

<div class="catalog">
    <div class="container">
        <h2>Выберите тест</h2>
        <div class="kartochki">
        <?php 
            $sql = "SELECT * FROM `tests`";  
            $result = mysqli_query($link, $sql); 

            while ($row = mysqli_fetch_assoc($result)) { 
                $id_test = $row['id']; 
                $nazvanie_test = $row['title']; 
                $description_test = $row['description']; 
                $img_test = $row['image']; 
        ?>
            <div class="kartochka">
                <img class="kartochka_img" src="<?php echo $img_test; ?>" alt="<?php echo $nazvanie_test; ?>">
                <h3 class="kartochka_h3"><?php echo $nazvanie_test; ?></h3>
                <div class="kartochka_d"><?php echo $description_test; ?></div>
                <a href="/career_service/test/<?php echo $id_test; ?>" class="kartochka_button">Пройти тест</a>
            </div>
        <?php } ?>
        </div>
    </div> 
</div>

 

<?php include "footer.php"; ?>
