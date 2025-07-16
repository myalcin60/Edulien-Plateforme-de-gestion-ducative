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

    <?php if ($_SESSION['role'] == 'teacher'): ?>
     <form action="../../src/controllers/class_controller.php" method="post">
    <h2 class="p-3">Classes</h2>

    <div class="container mb-4">
        <div class="row align-items-end">
            <div class="col-md-9 ">
                <label for="class_name" class="form-label">ClassName</label>
                <input type="text" id="class_name" name="class_name" class="form-control" placeholder="Enter class name">
            </div>
            <div class="col-md-3 d-flex w-25 ">
                <button type="submit" class="btn btn-primary ms-3 ">Save</button>
            </div>
        </div>
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
        <div class="d-flex flex-wrap justify-content-start">
            <?= $student_classes ?>
        </div>

    <?php endif; ?>

</body>

</html>