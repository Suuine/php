<?php
// public/delete.php

// Підключення залежностей
$pdo = require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../controllers/BookController.php';

// Отримання ID з URL
$id = $_GET['id'] ?? null;

// Перевірка наявності ID
if (!$id || !is_numeric($id)) {
    header('Location: index.php');
    exit;
}

// Перевірка методу запиту (можна додати POST для безпеки)
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Location: index.php');
    exit;
}

// Створення моделі та контролера
$model = new Book($pdo);
$controller = new BookController($model);

// Виклик методу видалення
$controller->delete($id);