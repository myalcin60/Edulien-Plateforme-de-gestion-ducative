<?php
include __DIR__ . '/../../src/services/class_services.php';
include __DIR__ . '/../../src/services/lesson_services.php';

$classes = show_classes();
$student_lessons = show_student_lessons();



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
    <div class="container-sm">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($_SESSION['role'] == 'teacher'): ?>
        <form action="../../src/controllers/class_controller.php" method="post">
            <h2 class="p-3 title">Classes</h2>

            <div class="container mb-4">
                <div class="item align-items-end">
                    <div class=" item align-items-end col-md-9 ">
                        <label for="class_name" class="form-label">Class</label>
                        <input type="text" id="class_name" name="class_name" class="form-control" placeholder="Enter class name">
                         <!-- <label for="lesson_name" class="form-label">Lesson</label>
                        <input type="text" id="lesson_name" name="lesson_name" class="form-control" placeholder="Enter lesson name">
                     -->
                    </div>
                    <div class=" d-flex w-25 ">
                        <button type="submit">Save</button>
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
            <?= $student_lessons ?>
        </div>

    <?php endif; ?>

</body>

</html>