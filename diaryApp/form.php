<?php

include 'header.php';

require_once 'inc/db-connection.php';

$postImage = null;

if (!empty($_POST) && $pdo) {

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $uploadDir = 'uploads/';

        $fileName = basename($_FILES['image']['name']);
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueName = uniqid() . '.' . $fileExt;
        $uploadFile = $uploadDir . $uniqueName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $postImage = $uniqueName;
        } else {
            echo "Помилка завантаження зображення. Перевірте дозволи або розмір файлу.";
        }
    }

    $title = $_POST['title'];
    $date = $_POST['date'];
    $text = $_POST['text'];

    $stmt = $pdo->prepare('INSERT INTO `entries` (title, date, text, image) VALUES (:title, :date, :text, :image)');

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':image', $postImage);

    $stmt->execute();

    header('Location: index.php');
    exit();
}

?>

<style>
    form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }
    input[type="text"], textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    input[type="submit"] {
        background-color: #28a745;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #218838;
    }
    input[type="date"] {
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>

<h2>Add New Diary Entry</h2>

<form action="form.php" method="post" enctype="multipart/form-data">
    <label for='imageUpload'>Upload an image:</label>
    <input type="file" name="image" id="imageUpload" accept="image/*"><br><br>

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>
    
    <label for="date">Date:</label><br>
    <input type="date" id="date" name="date" required><br><br>

    <label for="text">Entry Text:</label><br>
    <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>
    
    <input type="submit" value="Submit">
</form>

<?php include 'footer.php'; ?>
