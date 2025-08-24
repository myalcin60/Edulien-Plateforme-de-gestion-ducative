<?php
include_once __DIR__ . '/../../src/services/homework_services.php';

$homeworks = show_homeworks();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeworks</title>
</head>

<body>
    <h3>Homeworks</h3>
    <form action='../../src/controllers/homework_controller.php' method="GET">
        <?= $homeworks ?>
        <button type="submit">Delete</button>
    </form>


</body>

</html>