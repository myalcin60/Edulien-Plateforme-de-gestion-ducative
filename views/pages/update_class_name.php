<?php
include __DIR__ . '/../../src/services/class_services.php';
include __DIR__ . '/../partiel/auth_guard.php';
$class = update_class();

$profile = 'Profile';
$classes = 'Classes';
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
    <link rel="stylesheet" href="../css/class_page.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css" />
    <?php include '../partiel/dependencies.php' ?>

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
                <div class="container-sm">
                    <form action="../../src/controllers/class_controller.php" method="post">
                        <p class="p-3">Please enter the class name.</p>

                        <div class="container mb-4">
                            <div class="item">
                                <input type="hidden" name="id" value="<?= $class[0][0] ?>">

                                <div class="item col-md-9 ">

                                    <label for="class_name" class="form-label"> ClassName</label>
                                    <input type="text" id="class_name" name="class_name" class="form-control"
                                        placeholder="Enter class name" value="<?= $class[0]['className'] ?>">
                                </div>
                                <div class=" d-flex w-25">
                                    <button type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </main>
        <footer>
            <?php include '../compenents/footer.php' ?>
        </footer>
    </div>





</body>

</html>