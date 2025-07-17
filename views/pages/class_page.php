<?php
include __DIR__ . '/../../src/services/class_services.php';
include __DIR__ . '/../../src/services/student_service.php';
$classId = $_GET['id'];
$class = get_class_by_classId($classId);
$_SESSION['classId'] = $classId;
$students = show_students($classId);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Page</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>
    <div>
        <header>
            <?php
            include '../compenents/header.php';
            ?>
        </header>
        <div>
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

            <form class="form-sm" action="../../src/controllers/student_controller.php" method="post">
                <div class="container-md gap-3 p-3">

                    <h2> Class Name : <?= $class[0][1] ?> </h2>

                    <input type="hidden" name="classId" value="<?= $classId ?> ">
                </div>

                <div class="container-md d-flex  ">
                    <div class="container-sm mb-3 gap-3 d-flex">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mx-3 w-25">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </div>


            </form>


        </div>

        <div class="container-md mb-3">
            <div class="d-flex gap-3 p-3 justify-content-between">
                <h2>Students List</h2> <a style="text-decoration: none;" href="./teacher_dashboard.php?form=classes">
                    <h2 style="color:black"> Classes</h2>
                </a>
            </div>

            <div class="gap-3 p-3">
                <?= $students ?>
            </div>



        </div>
        <footer>
            <?php include '../compenents/footer.php' ?>
        </footer>
    </div>


</body>

</html>