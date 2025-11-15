<?php
include_once __DIR__ . '/../../src/services/homework_services.php';
$homeworks = show_homeworks();
$userid= $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
</head>

<body>
    <h3>Homeworks</h3>
    <form action='../../src/controllers/homework_controller.php' method="GET">
        <?= $homeworks?>
        <?php if($userid[0]=='T') : ?>
        <button type="submit">Delete</button>
        <?php else :?>
          <!-- <a href='../../views/pages/answer_hm.php?id=$homework_id' class='btn btn-warning btn-sm'> Add to Answer </a>  -->
        <?php endif; ?>
    </form>


</body>

</html>