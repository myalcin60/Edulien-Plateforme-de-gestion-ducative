<?php
include_once __DIR__ . '/../../src/services/service.php';

if ($_SESSION['id'][0] == 'S') {
    $homeworks = 'Homeworks';
    $create_homework = '';

} else {
    $menu = $_GET['action'] ?? 'create_homework';
    $create_homework = 'Create Homework';
    $homeworks = 'Homeworks';
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homevork</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/homework.css" />
</head>

<body>
    <div class="d-flex w-auto h-auto align-self-start gap-5 mb-5">
          <a style="text-decoration: none; font-size:large;"
            href="./teacher_dashboard.php?form=homework&action=homeworks">
            <?= $homeworks ?>
        </a>
        <a class="menu" style="text-decoration: none; font-size:large;"
            href="./teacher_dashboard.php?form=homework&action=create_homework">
            <?= $create_homework ?>
        </a>

      
    </div>
    <?php
    select_homework_menu($menu);
    ?>

</body>

</html>