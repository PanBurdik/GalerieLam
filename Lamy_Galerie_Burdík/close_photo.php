<?php
require_once 'db.php';

$dotaz = 'SELECT * FROM fotky  where id = :id';
$stmt = $conn->prepare($dotaz);
$result = $stmt->execute([
    ':id' => $_GET['id']]);
$vypis = $stmt->fetch();

$dotazz = 'SELECT * FROM fotky WHERE id_slozka = :id_slozka and id < :id order by id desc';
$stmt = $conn->prepare($dotazz);
$result = $stmt->execute([
    ':id' => $_GET['id'],
    ':id_slozka' => $vypis['id_slozka']
]);
$leva = $stmt->fetch();

$dotas = 'SELECT * FROM fotky WHERE id_slozka = :id_slozka and id > :id order by id asc';
$stmt = $conn->prepare($dotas);
$result = $stmt->execute([
    ':id' => $_GET['id'],
    ':id_slozka' => $vypis['id_slozka']
]);
$prava = $stmt->fetch();


$starss = 'SELECT AVG(star) AS stars FROM fotky;';
$stmt = $conn->prepare($starss);
$result = $stmt->execute();
$star = $stmt->fetch();




?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="lamasS.css" >
    <title>Fotografie</title>
</head>
<body>
<h1><?= $vypis['title']; ?></h1>
<ul class="form2">
    <li>
    <a href="delete3.php?id=<?= $vypis['id']; ?>">Odstranit fotku</a>
    </li>
</ul>
<div class="images3">
    <?php if (isset($leva['id'])): ?>
    <a href="close_photo.php?id=<?= $leva['id']; ?>"> <img  class="sipka" src="files/white-arrow-49%20-%20kopie.png" alt="šipka levo"></a>
    <?php else: ?>
    <?php endif; ?>
    <img class="close" src="files/<?= $vypis['id']; ?>.<?= $vypis['extension']; ?>" alt="<?= $vypis['title']; ?>">
    <?php if (isset($prava['id'])): ?>
    <a href="close_photo.php?id=<?= $prava['id']; ?>"> <img  class="sipka" src="files/white-arrow-49.png" alt="šipka pravo"></a>
    <?php else: ?>
    <?php endif; ?>
</div>
Likes:
<a href="likes.php?id=<?= $_GET['id']; ?>"><img class="like" src="files/black-like-icon-png-13.png" alt="like"> <?php if ($vypis == null): ?>0<?php else: ?><?= $vypis['likes']; ?><?php endif; ?></a>
<?php
$date = new DateTime($vypis['created_at']);
?>
<br>



<h2>Datum vytvoření:
    <time datetime="<?= $date->format(DATE_ISO8601) ?>">
        <?= $date->format('d.m.Y H:i') ?>
    </time>
</h2>
</body>
</html>