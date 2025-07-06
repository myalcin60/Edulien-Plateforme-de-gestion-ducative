<?php
include __DIR__ . '/../../src/services/class_services.php';
$classes = show_classes();
$student_classes = show_class_student();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
     <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php if ($_SESSION['role'] == 'Teacher'): ?>
        <form action="../../src/controllers/class_controller.php" method="post">
            <h2 class="p-3">Classes </h2>
            <div class="d-flex gap-3 mb-3 p-3">
                
                <label for="text" class="form-label">Class Name</label>
                <input type="text" class="form-control" name="class_name">
                <button type="submit" class="">Save</button>
            </div>
        </form>
        <div>
            <form action="../../src/controllers/class_controller.php" method="get">

                <div class="gap-3 p-3 ">
                    <h2> Clasess</h2>
                    <?= $classes ?>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="d-flex">
            <?= $student_classes ?>
        </div>

    <?php endif; ?>

</body>

</html>