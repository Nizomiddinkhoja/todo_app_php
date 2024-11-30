<?php
require_once("include/head.php");
?>
    <h1><?=isset($task)? 'Редактирование задачи' : 'Создание задачи'?></h1>
    <form method="POST">
        <div class="form-group">
            <label for="username">имя пользователя</label>
            <input id="username"
                   type="text"
                   name="username"
                   class="form-control"
                   value="<?= isset($task['username']) ? $task['username'] : '' ?>"
                   required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input id="email"
                   type="email"
                   name="email"
                   class="form-control"
                   value="<?= isset($task['email']) ? $task['email'] : '' ?>"
                   required>
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <textarea id="text"
                      name="text"
                      class="form-control"
                      required><?= isset($task['text']) ? $task['text'] : '' ?></textarea>
        </div>

        <?php if (isset($task)): ?>
            <div class="form-group">
                <label for="completed">Статус</label>
                <input id="completed"
                       type="checkbox"
                       name="completed"
                       value="<?= isset($task['completed']) ? $task['completed'] : '' ?>"
                    <?= $task['completed'] ? 'checked' : '' ?>>
            </div>
        <?php endif; ?>
        <button type="submit"
                class="btn btn-primary">
            <?=isset($task)? 'Редактировать' : 'Создать'?>
        </button>
    </form>
<?php
require_once("include/foot.php");
?>