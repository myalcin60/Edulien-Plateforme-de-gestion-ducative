<?php
include __DIR__ . '/../../src/services/service.php';
$menu = isset($_GET['form']) ? $_GET['form'] : null;

$profile = 'Profile';
$classes = 'Classes';
$homework = 'Homework';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
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
            <div class="left-menu box-shadow ">
                <a class="menu" style="text-decoration: none;" href="./teacher_dashboard.php?form=profile">
                    <button> <?= $profile ?></button>
                </a>
                <a style="text-decoration: none;" href="./teacher_dashboard.php?form=classes">
                    <button> <?= $classes ?></button>
                </a>
                <a style="text-decoration: none;" href="./teacher_dashboard.php?form=homework">
                    <button> <?= $homework ?></button>
                </a>
            </div>
            <div class="right-menu box-shadow">
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