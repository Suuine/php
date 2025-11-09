<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleAut.css">
</head>
<body>
    <header>
        <h1>Authomatic Image List</h1>
    </header>
    
    <main><?php
        $handle = opendir(__DIR__ . '/images');

        $images = [];
        if ($handle) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry == "." || $entry == "..") {
                    continue;
                }
                $extension = pathinfo($entry, PATHINFO_EXTENSION);
                if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                    continue;
                } 
                $fileWithoutExt = pathinfo($entry, PATHINFO_FILENAME);

                $txtFile = __DIR__ . '/images/' . $fileWithoutExt . '.txt';               

                if(file_exists($txtFile)){
                    $text = file_get_contents($txtFile);
                    $info = explode("\n", $text);
                    $title = $info[0] ?? 'No Title';
                    $description = $info[1] ?? 'No Description';
                    
                    $images[] =[
                        'image' => $entry,
                        'title' => $title,
                        'description' => $description
                 ];
                }                                                               
            }
            closedir($handle);
        }
    ?></main>
    <section>
        <?php foreach ($images as $image): ?>
            <div style="display: inline-block; margin: 10px; text-align: center; width: 100%; text-align: center;">
                <img src="images/<?php echo htmlspecialchars($image['image']); ?>" alt="<?php echo htmlspecialchars($image['title']); ?>" style="max-width: 200px; max-height: 200px; display: block; margin: 0 auto;"/>
                <h2><?php echo htmlspecialchars($image['title']); ?></h2>
                <p><?php echo htmlspecialchars($image['description']); ?></p>
            </div>
        <?php endforeach; ?>
</body>
</html>