<?php
include __DIR__ . '/../../src/services/class_services.php';
include __DIR__ . '/../../src/services/student_service.php';
$classId = $_GET['id'];
$class = get_class_by_classId($classId);
// echo $class[0]["teacherId"];

$_SESSION['classId'] = $classId;
$students = show_students($classId);

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
    <title>Class Page</title>
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
        <main class="d-sm-flex justify-content-center gap-5 my-5">
            <?php include '../compenents/left-menu.php' ?>

            <div class="right-menu box-shadow ">
                <div class="container-sm ">
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

                
                <form class="form-sm" action="../../src/controllers/class_controller.php" method="post">
                    <div>
                        <h2 class="p-3 title"> Class Name : <?= $class[0][1] ?> </h2>
                        <input type="hidden" name="classId" value="<?= $classId ?> ">
                        <input type="hidden" name="teacherId" value="<?= $class[0]["teacherId"] ?> ">
                        <input type="hidden" name="formType" value="create_lesson">
                    </div>
                    <div class="container mb-4  gap-3 d-flex  ">
                        <div class="container-sm  gap-5 d-flex">
                            <label for="lesson" class="form-label">Lesson</label>
                            <input type="text" class="form-control" id="lesson" name="lesson">
                        </div>
                        <div class=" d-flex w-25 ">
                            <button type="submit">Save</button>
                        </div>
                    </div>
                </form>
                   <div class="box-shadow container-md mb-3">
                    <div class="d-flex gap-3 p-3 justify-content-between">
                        <h2>Lesson List</h2> <a style="text-decoration: none;" href="./teacher_dashboard.php?form=classes">
                            <h2 style="color:black"> Classes</h2>
                        </a>
                    </div>

                    <div class="gap-3 p-3">
                        <?= $students ?>
                    </div>
                </div>

                <form class="form-sm" action="../../src/controllers/student_controller.php" method="post">
                    <!-- <div>
                        <h2 class="p-3 title"> Class Name : <?= $class[0][1] ?> </h2>
                        <input type="hidden" name="classId" value="<?= $classId ?> ">
                    </div> -->
                    <div class="container mb-4  gap-3 d-flex  ">
                        <div class="container-sm  gap-5 d-flex">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class=" d-flex w-25 ">
                            <button type="submit">Save</button>
                        </div>
                    </div>
                </form>


                <div class="box-shadow container-md mb-3">
                    <div class="d-flex gap-3 p-3 justify-content-between">
                        <h2>Students List</h2> <a style="text-decoration: none;" href="./teacher_dashboard.php?form=classes">
                            <h2 style="color:black"> Classes</h2>
                        </a>
                    </div>

                    <div class="gap-3 p-3">
                        <?= $students ?>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <?php include '../compenents/footer.php' ?>
        </footer>
    </div>


</body>

</html>