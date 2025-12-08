<h2 class="mb-3">Редагувати книгу</h2>

<form action="edit.php?id=<?= $book['id'] ?>" method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">Назва книги</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Автор</label>
        <input type="text" class="form-control" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="year" class="form-label">Рік видання</label>
        <input type="number" class="form-control" id="year" name="year" value="<?= $book['year'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Оновити</button>
    <a href="index.php" class="btn btn-secondary">Скасувати</a>
</form>