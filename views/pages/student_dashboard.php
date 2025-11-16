<?php
include __DIR__ . '/../../src/services/service.php';
include __DIR__ . '/../partiel/auth.php';
$menu = isset($_GET['form']) ? $_GET['form'] : null;

$profile = 'Profile';
$classes = 'Lessons';
$homework = 'Homework';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/teacher_dashboard.css" />

</head>

<body>
    <div>
        <header>
            <?php
            include '../compenents/header.php';
            ?>
        </header>

        <main class="d-flex justify-content-center gap-5 my-5">
            <?php include '../compenents/left-menu.php'
            ?>
            <div class="right-menu box-shadow">
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>
                <?php
                select_menu($menu);
                ?>
            </div>
        </main>
        <footer>
            <?php include '../compenents/footer.php'  ?>
        </footer>
    </div>

</body>

</html>