<?php

require_once 'db.php';

$sql = 'SELECT * FROM slozka ORDER BY created_at DESC';
$stmt = $conn->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll();

if(isset($_POST['title'])){
  $dotaz = 'INSERT INTO slozka SET title = :title, created_at = now();';
  $stmt = $conn->prepare($dotaz);
  $result = $stmt->execute([
       ':title' => $_POST['title']
   ]);
    header('location: index.php');
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="lamasS.css" >
    <title>Lamy Galerie</title>
</head>
<body>
<h1>Lamy Galerie</h1>
<div class="images">
    <?php foreach($images as $image): ?>
        <?php
        $date = new DateTime($image['created_at']);

        $sql = 'SELECT * FROM fotky WHERE id_slozka = :id LIMIT 1';
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            ':id' => $image['id']
        ]);
        $ima = $stmt->fetch();
        ?>
        <figure>
            <a href="Fotky.php?id=<?= $image['id']; ?>">
                <?php if (isset($ima['id'])): ?>
                    <img class="close" src="files/<?= $ima['id']; ?>.<?= $ima['extension']; ?>" alt="<?= $ima['title']; ?>">
                <?php else: ?>
                    <img src="files/slozka.png" alt="<?= $image['title']; ?>">
                <?php endif; ?>
            </a>
            <figcaption>
                <?= $image['title']; ?>
                <br>
                <time datetime="<?= $date->format(DATE_ISO8601) ?>">
                    <?= $date->format('d.m.Y H:i') ?>
                </time>
            </figcaption>
        </figure>
    <?php endforeach; ?>

</div>
<div class="form1">
    <h2>Přidat Galerii</h2>
    <form method="post">
        <input type="text" placeholder="Název galerie" name="title">
        <button>Přidat</button>
    </form>
</div>
</body>
</html>