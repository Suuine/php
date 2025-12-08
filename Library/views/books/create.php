<h2 class="mb-3">Додати нову книгу</h2>

<?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form action="create.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Назва книги <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control <?= (isset($errors) && !empty($errors)) ? 'is-invalid' : '' ?>" 
                       id="title" 
                       name="title" 
                       value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
                       placeholder="Введіть назву книги"
                       required>
            </div>
            
            <div class="mb-3">
                <label for="author" class="form-label">Автор <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control <?= (isset($errors) && !empty($errors)) ? 'is-invalid' : '' ?>" 
                       id="author" 
                       name="author" 
                       value="<?= htmlspecialchars($_POST['author'] ?? '') ?>"
                       placeholder="Введіть ім'я автора"
                       required>
            </div>
            
            <div class="mb-3">
                <label for="year" class="form-label">Рік видання <span class="text-danger">*</span></label>
                <input type="number" 
                       class="form-control <?= (isset($errors) && !empty($errors)) ? 'is-invalid' : '' ?>" 
                       id="year" 
                       name="year" 
                       min="1000" 
                       max="<?= date('Y') ?>"
                       value="<?= htmlspecialchars($_POST['year'] ?? date('Y')) ?>"
                       placeholder="Наприклад: <?= date('Y') ?>"
                       required>
                <div class="form-text">Рік має бути від 1000 до <?= date('Y') ?></div>
            </div>
            
            <hr>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Зберегти книгу
                </button>
                <a href="index.php" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Скасувати
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>