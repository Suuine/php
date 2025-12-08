<h2 class="mb-3">Список книг</h2>

<a href="create.php" class="btn btn-success mb-3">Додати нову книгу</a>

<?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['message']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (empty($books)): ?>
    <div class="alert alert-info">
        Книг поки немає. <a href="create.php">Додайте першу книгу</a>
    </div>
<?php else: ?>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Назва</th>
                <th>Автор</th>
                <th>Рік</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book['id']) ?></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['author']) ?></td>
                <td><?= htmlspecialchars($book['year']) ?></td>
                <td>
                    <a href="show.php?id=<?= $book['id'] ?>" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-warning btn-sm">Редагувати</a>
                    <a href="delete.php?id=<?= $book['id'] ?>" class="btn btn-danger btn-sm" 
                       onclick="return confirm('Ви впевнені, що хочете видалити книгу \'<?= htmlspecialchars($book['title']) ?>\'?')">Видалити</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>