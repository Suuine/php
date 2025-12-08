<div class="card">
    <div class="card-header">
        Деталі книги #<?= $book['id'] ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($book['title']) ?></h5>
        <p class="card-text"><strong>Автор:</strong> <?= htmlspecialchars($book['author']) ?></p>
        <p class="card-text"><strong>Рік видання:</strong> <?= $book['year'] ?></p>
        
        <a href="index.php" class="btn btn-secondary">Назад до списку</a>
        <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-warning">Редагувати</a>
    </div>
</div>