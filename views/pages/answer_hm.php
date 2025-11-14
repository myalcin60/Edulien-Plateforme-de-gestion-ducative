<?php

include_once __DIR__ . '/../../src/services/homework_services.php';
include __DIR__ . '/../../src/services/service.php';
include __DIR__ . '/../partiel/auth.php';

$menu = isset($_GET['form']) ? $_GET['form'] : null;

$profile = 'Profile';
$classes = 'Lessons';
$homework = 'Homework';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$hm = show_homework($id);
$userid = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/class_page.css">
    <link rel="stylesheet" href="../css/homework.css" />
    <link rel="stylesheet" href="../css/teacher_dashboard.css" />
</head>

<body>
    <div>
        <header>
            <?php
            include '../compenents/header.php';
            ?>
        </header>
        <main class="d-sm-flex justify-content-center gap-5 my-5">
            <?php include '../compenents/left-menu.php'
            ?>

            <div class="right-menu box-shadow ">
                <h3>Homework</h3>

                <?= $hm ?>
                <form action="../../src/controllers/homework_controller.php" method="POST" enctype="multipart/form-data">
                    <div class="textarea">
                        <label for="homework">Answer</label>
                        <textarea name="homework" id="homework"><?= htmlspecialchars($homeworkText ?? '') ?></textarea>
                    </div>

                    <div>
                        <label>Upload File (Image / PDF)</label>
                        <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf">
                    </div>

                    <button type="submit">Send</button>
        </main>
        </form>
    </div>
    <footer>
        <?php include '../compenents/footer.php' ?>
    </footer>
    </div>
</body>

</html>