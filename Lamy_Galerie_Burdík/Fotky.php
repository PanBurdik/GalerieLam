<?php


require_once 'db.php';

    $dotaz = 'SELECT * FROM slozka where id = :id';
    $stmt = $conn->prepare($dotaz);
        $result = $stmt->execute([
        ':id' => $_GET['id']]);
    $vypisi = $stmt->fetch();

    $dotaz = 'SELECT * FROM fotky  where id_slozka = :id';
    $stmt = $conn->prepare($dotaz);
    $result = $stmt->execute([
        ':id' => $_GET['id']]);
    $vypis = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="lamasS.css">
    <title>Fotky Lamy</title>
</head>
<body>
<?php
$date = new DateTime($vypisi['created_at']);
?>
<h1><?= $vypisi['title']; ?></h1>
<h2>Datum vytvoření:
    <time datetime="<?= $date->format(DATE_ISO8601) ?>">
        <?= $date->format('d.m.Y H:i') ?>
    </time>
</h2>
<ul class="form2">
    <li>
            <a href="delete.php?id=<?=$_GET['id']?>">Smazat fotky</a>
    </li>
    <li>
            <a href=delete2.php?id=<?=$_GET['id']?>">Smazat galerii</a>
    </li>
</ul>
<div class="images2">
    <?php foreach($vypis as $image): ?>
        <figure>
            <a href="close_photo.php?id=<?= $image['id']; ?>"><img src="files/<?= $image['id']; ?>.<?= $image['extension']; ?>" alt="<?= $image['title']; ?>"></a>
        </figure>
    <?php endforeach; ?>
</div>
<div class="form1">
    <div>
        <h2>Přidat fotku</h2>
            <form method="post" enctype="multipart/form-data" action="upload.php?slozky=<?=$_GET['id']?>">
                <div>
                    <label for="title">
                        Popisek:
                        <input type="text" name="title" id="title">
                    </label>
                </div>
                <div>
                <label for="file">
                    Soubor: <input type="file"
                                   id="file"
                                   name="file"
                                   accept="image/*">
                </label>
                </div>
                <div>
                     <button>Nahrát soubor</button>
                </div>
            </form>
    </div>
</div>
</body>
</html>