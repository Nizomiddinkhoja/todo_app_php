<?php
require_once("include/head.php");
?>
<h1>Авторизация</h1>
<form method="POST">
    <div class="form-group">
        <label for="username">Логин</label>
        <input id="username"
               type="text"
               name="username"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input id="password"
               type="password"
               name="password"
               class="form-control"
               required>
    </div>

    <?php if (isset($message) && $message): ?>
        <div class="alert alert-danger" role="alert">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <button type="submit"
            class="btn btn-primary">
        Вход
    </button>
</form>
<?php
require_once("include/foot.php");
?>
