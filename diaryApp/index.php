<?php 

require_once 'inc/db-connection.php';

date_default_timezone_set('Europe/London');
$perpage = 9;

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$start = ($page - 1) * $perpage;


if ($pdo) {
    $stmt = $pdo->prepare('SELECT * FROM `entries` ORDER BY date DESC  LIMIT :perpage OFFSET :start');
    $startParam = (int) $start;
    $perpageParam = (int) $perpage;
        $stmt->bindValue(':perpage', $perpageParam, PDO::PARAM_INT);
    $stmt->bindValue(':start', $startParam, PDO::PARAM_INT);

    $stmt->execute();
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<?php include 'header.php'; ?>

<style>
    .entry {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        background-color: #f9f9f9;
        h2{
            margin-top: 0;
        }
        p{
            margin-bottom: 0;
        }
        small{
            color: #888;
        }
    }
</style>
<?php foreach ($entries as $entry): ?>
    <div class="entry">
        <?php
        $dateExploded = explode('-', $entry['date']);
        $year = $dateExploded[0];
        $month = $dateExploded[1];
        $day = $dateExploded[2];
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        ?>
        <small><?php echo date('l, F j, Y', $timestamp); ?></small>
        <h2><?php echo htmlspecialchars($entry['title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($entry['text'])); ?></p>
        <?php if (!empty($entry['image'])): ?>
            <img src="uploads/<?php echo htmlspecialchars($entry['image']); ?>" alt="Entry Image" style="max-width: 100%; height: auto; border-radius: 5px;">
        <?php endif; ?>
        <small>Created at: <?php echo htmlspecialchars($entry['date']); ?></small>
    </div>
<?php endforeach; ?>

<section class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>" class="prev">Previous</a>
    <?php endif; ?>
    <a href="?page=<?php echo $page + 1; ?>" class="next">Next</a>
</section>




<?php include 'footer.php'; ?>