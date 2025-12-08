<?php

class BookController {
    private $model;
    private $viewsPath;

    public function __construct($model) {
        $this->model = $model;
        $this->viewsPath = dirname(__DIR__) . '/views';
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $books = $this->model->getAll();
        $this->loadView('books/index', ['books' => $books]);
    }

    public function show($id) {
        $book = $this->model->getById($id);
        
        if (!$book) {
            $this->redirect('index.php', 'Книгу не знайдено');
        }
        
        $this->loadView('books/show', ['book' => $book]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $this->sanitize($_POST['title'] ?? '');
            $author = $this->sanitize($_POST['author'] ?? '');
            $year = $this->sanitize($_POST['year'] ?? '');

            $errors = [];

            if (empty($title)) {
                $errors[] = "Назва книги обов'язкова";
            }
            if (empty($author)) {
                $errors[] = "Автор обов'язковий";
            }
            if (empty($year) || !is_numeric($year)) {
                $errors[] = "Рік видання має бути числом";
            }
            if ($year < 1000 || $year > date('Y')) {
                $errors[] = "Невірний рік видання";
            }

            if (empty($errors)) {
                if ($this->model->create($title, $author, $year)) {
                    $this->redirect('index.php', 'Книгу успішно додано');
                } else {
                    $errors[] = "Помилка при додаванні книги";
                }
            }

            $this->loadView('books/create', ['errors' => $errors]);
        } else {
            $this->loadView('books/create');
        }
    }

    public function edit($id) {
        $book = $this->model->getById($id);
        
        if (!$book) {
            $this->redirect('index.php', 'Книгу не знайдено');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $this->sanitize($_POST['title'] ?? '');
            $author = $this->sanitize($_POST['author'] ?? '');
            $year = $this->sanitize($_POST['year'] ?? '');

            $errors = [];

            if (empty($title)) {
                $errors[] = "Назва книги обов'язкова";
            }
            if (empty($author)) {
                $errors[] = "Автор обов'язковий";
            }
            if (empty($year) || !is_numeric($year)) {
                $errors[] = "Рік видання має бути числом";
            }
            if ($year < 1000 || $year > date('Y')) {
                $errors[] = "Невірний рік видання";
            }

            if (empty($errors)) {
                if ($this->model->update($id, $title, $author, $year)) {
                    $this->redirect('index.php', 'Книгу успішно оновлено');
                } else {
                    $errors[] = "Помилка при оновленні книги";
                }
            }

            $this->loadView('books/edit', ['book' => $book, 'errors' => $errors]);
        } else {
            $this->loadView('books/edit', ['book' => $book]);
        }
    }

    public function delete($id) {
        if ($this->model->delete($id)) {
            $this->redirect('index.php', 'Книгу успішно видалено');
        } else {
            $this->redirect('index.php', 'Помилка при видаленні книги');
        }
    }

    private function loadView($view, $data = []) {
        extract($data);
        
        require $this->viewsPath . '/header.php';
        require $this->viewsPath . '/' . $view . '.php';
        require $this->viewsPath . '/footer.php';
    }

    private function redirect($location, $message = null) {
        if ($message) {
            $_SESSION['message'] = $message;
        }
        header("Location: $location");
        exit;
    }

    private function sanitize($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
