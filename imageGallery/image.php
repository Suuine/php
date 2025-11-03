
<?php 
if(!empty($_GET['image'])) {

    $image = $_GET['image'];
    include './inc/functions.inc.php';
    include './inc/images.inc.php';
    if (array_key_exists($image, $imageTitle)) {
        $title = $imageTitle[$image];
        $description = $imageDescription[$image];
    } else {
        header('Location: gallery.php');
        exit();
    }
} else {
    header('Location: gallery.php');
    exit();
}
?>

<?php include './views/header.php'; ?>
<section class="image-detail">
    <div class="image-card
">
        <img src="./images/<?= e($image) ?>" alt="<?= $title ?>">
        <h2><?= $title ?></h2>
        <p><?= $description ?></p>
        <a href="gallery.php" class="back-link">Back to Gallery</a>
    </div>
</section>
<?php include './views/footer.php'; ?>