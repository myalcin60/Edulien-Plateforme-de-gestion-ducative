<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
    <?php include '../partiel/dependencies.php' ?>
    <link rel="stylesheet" href="../css/header.css" />

</head>

<body>
    <div class="header">
        <nav class=" d-flex navbar navbar-expand-lg text-light">
            <div class="container-fluid text-light" id="navbar">

                <div class="d-flex gap-3 align-items-center text-light">
                    <img class="d-md-block d-none logo-img" src="\edu_php\views\assets\logo.jpg" alt="logo">

                    <?php if (isset($_SESSION['id'][0]) == 'T'): ?>
                        <a class="navbar-brand text-light" href="../pages/teacher_dashboard.php">EDULIEN</a>
                    <?php elseif (isset($_SESSION['id'][0]) == 'S'): ?>
                        <a class="navbar-brand text-light" href="../pages/student_dashboard.php">EDULIEN</a>
                    <?php else: ?>
                        <a class="navbar-brand text-light" href="../pages/index.php">EDULIEN</a>
                    <?php endif; ?>

                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="flex collapse navbar-collapse gap-3" id="navbarSupportedContent">
                    <div class="d-flex gap-3">
                        <a class="nav-link active" aria-current="page" href="../pages/index.php">Home</a>
                        <a class="nav-link active" aria-current="page" href="#">About</a>
                        <a class="nav-link active" aria-current="page" href="#">Contact</a>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="d-flex me-2 gap-3">

                            <?php if (isset($_SESSION['id'])): ?>
                                <form class="d-flex gap-3 align-items-end content-items-end"
                                    action="../../src/controllers/user_controller.php" method="post">
                                    <div>
                                        <?php if ($_SESSION['id'][0] == 'T'): ?>
                                            <a class="navbar-brand text-light" href="../pages/teacher_dashboard.php">
                                                <i class="ikon fa-solid fa-user"></i>
                                                <?php echo $_SESSION['first_name']; ?>
                                                <?php echo $_SESSION['last_name']; ?>
                                            </a>
                                        <?php elseif (($_SESSION['id'][0]) == 'S'): ?>
                                            <a class="icon_prfl navbar-brand text-light" href="../pages/student_dashboard.php">
                                                <i class="ikon fa-solid fa-user"></i>
                                                <?php echo $_SESSION['first_name']; ?>
                                                <?php echo $_SESSION['last_name']; ?>
                                            </a>
                                        <?php else: ?>
                                        <?php endif; ?>

                                    </div>
                                    <input type="hidden" name="action" value="logout">
                                    <button class="btn btn-link " style="background:var(--btn-color); color:white" name="logout">Logout</button>
                                </form>


                            <?php else: ?>
                                <a style="text-decoration: none;" href="./main.php?form=login"> Login</a>
                                <a style="text-decoration: none;" href="./main.php?form=signup"> SignUp</a>

                            <?php endif; ?>


                        </div>

                    </div>
                </div>
            </div>
        </nav>

    </div>

</body>

</html>