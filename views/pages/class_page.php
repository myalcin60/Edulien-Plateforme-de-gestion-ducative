<?php
include __DIR__ . '/../../src/services/service.php';
include __DIR__ . '/../../src/services/class_services.php';
include __DIR__ . '/../../src/services/student_service.php';
include __DIR__ . '/../../src/services/lesson_services.php';
include __DIR__ . '/../partiel/auth.php';

$classId = $_GET['classId'] ;
$class = get_class_by_classId($classId);
$lessons= show_lessons($classId);
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
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/teacher_dashboard.css" />
    <link rel="stylesheet" href="../css/class_page.css">

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
                <form class="form-sm" action="../../src/controllers/lesson_controller.php" method="post">
                    <div>
                        <h2 class="p-3 title"> Class Name : <?= $class[0][1] ?? null ?> </h2>
                        <input type="hidden" name="classId" value="<?= $classId ?> ">
                        <input type="hidden" name="teacherId" value="<?= $class[0]["teacherId"] ?> ">
                        <input type="hidden" name="formType" value="create_lesson">
                    </div>
                    <div class="container mb-4  gap-3 d-flex  ">
                        <div class="container-sm  gap-5 d-flex">
                            <label for="lesson" class="form-label">Lesson</label>
                            <input type="text" class="form-control" id="lesson" name="lesson" placeholder="Lesson Name">
                        </div>
                        <div class=" d-flex w-25 ">
                            <button type="submit">Save</button>
                        </div>
                    </div>
                </form>
                        
                <div class="box-shadow container-md mb-3">
                    <div class="d-flex gap-3 p-3 justify-content-between">
                        <h2>Lesson List</h2> <a style="text-decoration: none;"
                            href="./teacher_dashboard.php?form=classes">
                            <h2 style="color:black"> Classes</h2>
                        </a>
                    </div>

                    <div class="gap-3 p-3">
                        <?= $lessons ?>
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