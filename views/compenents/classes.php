<?php
include __DIR__ . '/../../src/services/class_services.php';

$classes = show_classes();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
</head>

<body>
    <h2>Classes </h2>
    <form action="../../src/controllers/class_controller.php" method="post">
        <div class="d-flex gap-3 mb-3">
            <label for="text" class="form-label">Class Name</label>
            <input type="text" class="form-control" id="text" name="class_name">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <div>
        <h2> Clasess</h2>
        <div class="d-flex">
            <a href="../pages/class_page.php">
                <?= $classes ?>
            </a>

        </div>
    </div>
</body>

</html>