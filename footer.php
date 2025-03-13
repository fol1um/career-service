<div class="popup" id="loginPopup" onclick="closePopup(event, 'loginPopup')">
        <div class="popup-content" onclick="event.stopPropagation()">
            <h2>Вход</h2>
            <div>Нет учётной записи? <span onclick="switchPopup('loginPopup', 'registerPopup')">Регистрация</span></div>
            <form method="POST">
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="pass" placeholder="Пароль" required>
                <button type="submit">Войти</button>
            </form>

        </div>
    </div>
    
    <div class="popup" id="registerPopup" onclick="closePopup(event, 'registerPopup')">
        <div class="popup-content" onclick="event.stopPropagation()">
            <h2>Регистрация</h2>
            <div>Есть учётная запись? <span onclick="switchPopup('registerPopup', 'loginPopup')">Войти</span></div>
            <form method="POST">
            <input type="text" name="name" placeholder="ФИО">
            <input type="email" name="email" placeholder="E-mail">
            <input type="date" name="birth_date" placeholder="Дата рождения"> 
            <input type="password" name="pass" placeholder="Пароль">
            <button type="submit">Регистрация</button>
            </form>
        </div>
    </div>
    
    <script>
    function openPopup(popupId) {
        document.getElementById(popupId).classList.add("active");
    }

    function closePopup(event, popupId) {
        if (event.target.id === popupId) {
            document.getElementById(popupId).classList.remove("active");
        }
    }

    function switchPopup(closeId, openId) {
        document.getElementById(closeId).classList.remove("active");
        document.getElementById(openId).classList.add("active");
    }

    
</script>

</body>
</html>
