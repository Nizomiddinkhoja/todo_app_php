<?php
require_once("include/head.php");
?>
    <h1>Список задач</h1>
    <a href="?action=create" class="btn btn-primary my-1">Добавить задачу</a>

    <table class="table table-bordered">
        <thead>
        <tr class="d-flex">
            <th class="col-3 cut-text">
                <a href="?sort=username&order=<?= $data['order'] == 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $data['page'] ?>">
                    имя пользователя
                </a>
            </th>
            <th class="col-3 cut-text">
                <a href="?sort=email&order=<?= $data['order'] == 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $data['page'] ?>">
                    email
                </a>
            </th>
            <th class="col-3 cut-text">текст задачи</th>
            <th class="w-100 cut-text">
                <a href="?sort=completed&order=<?= $data['order'] == 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $data['page'] ?>">
                    статус
                </a>
            </th>
            <?php if ($loggedIn): ?>
                <th class="col-1"></th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($data['tasks'])): ?>
            <?php foreach ($data['tasks'] as $task): ?>
                <tr class="d-flex">
                    <td class="col-3 cut-text"><?= htmlspecialchars($task['username']) ?></td>
                    <td class="col-3 cut-text"><?= htmlspecialchars($task['email']) ?></td>
                    <td class="col-3 cut-text"><?= htmlspecialchars($task['text']) ?></td>
                    <td class="w-100 cut-text">
                        <?php
                        echo $task['completed'] ? 'Выполнено' : 'Не выполнено';
                        if ($loggedIn && isset($task['admin_edited']) && $task['admin_edited']) {
                            echo ', Отредактировано администратором';
                        }
                        ?>
                    </td>
                    <?php if ($loggedIn): ?>
                        <td class="col-1">
                            <a class="mx-1 text-warning" href="?action=edit&id=<?= $task['id'] ?>">
                                <i class="fa fa-pen" aria-hidden="true"></i>
                            </a>
                            <a class="mx-1 text-danger" href="?action=delete&id=<?= $task['id'] ?>">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>


<?php if (isset($data['page_count']) && $data['page_count'] > 1): ?>
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $data['page_count']; $i++): ?>
                <li class="page-item <?= $data['page'] == $i ? 'active' : '' ?>">
                    <a class="page-link"
                       href="?page=<?= $i ?>&sort=<?= $data['sort'] ?>&order=<?= $data['order'] ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php
require_once("include/foot.php");
?>