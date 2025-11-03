<?php
include './inc/functions.inc.php';
include './inc/images.inc.php';

?>
<?php include './views/header.php'; ?>

<section class ="gallery">
    <div class='card'>       
        <?php foreach ($imageTitle as $image => $title) : ?>
            <div class="image-card">
                <a href="image.php?<?php echo http_build_query(['image' => $image]); ?>">
                <img src="./images/<?= rawurldecode($image) ?>" alt="<?= $title ?>">
                <h2><?= $title ?></h2>
                <p><?= $imageDescription[$image] ?></p>
                </a>
            </div>
        <?php endforeach; ?>
        </div>
</section>


<?php include './views/footer.php'; ?>