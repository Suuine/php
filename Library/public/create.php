<?php
$pdo = require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../controllers/BookController.php';

$model = new Book($pdo);
$controller = new BookController($model);

$controller->create();