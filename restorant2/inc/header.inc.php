<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Restorant</title>
    <link rel="stylesheet" href="./main.css" />
  </head>
  <body>
    <header style = "background-color: 
    <?php if(isset($color)): ?>
    <?php echo $color; ?>
    <?php else: ?>
    #4f1c7cff;
    <?php endif; ?>">
      <h1>
        <?php if(isset($pageTitle)): ?>
        <?php echo $pageTitle; ?>
        <?php else: ?>
        Welcome to Our Restorant
        <?php endif; ?></h1>
      <nav>
      <ul>
        <?php 
        if(!isset($pageKey)){
          $pageKey = '';
        }
        ?>
        <li><a class = "<?php if(!empty($pageKey) && $pageKey === 'main'): ?> active <?php endif; ?>" href="main.php">Main</a></li>
        <li><a <?php if(!empty($pageKey) && $pageKey === 'ingredients'): ?> class="active" <?php endif; ?> href="ingredients.php">Ingredients</a></li>
        <li><a <?php if(!empty($pageKey) && $pageKey === 'menu'): ?> class="active" <?php endif; ?> href="menu.php">Menu</a></li>
      </ul>
    </nav>
    </header> 
    
    <main>