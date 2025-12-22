<?php
include_once __DIR__ . '/../../src/services/homework_services.php';
$homeworks = show_homeworks();
$userid= $_SESSION['id'];

?>

<div>
    <h3>Homeworks</h3>
    <form action='../../src/controllers/homework_controller.php' method="GET">
        <?= $homeworks?>
        <?php if($userid[0]=='T') : ?>
        <button type="submit">Delete</button>
        <?php else :?>
        <?php endif; ?>
    </form>
</div>

