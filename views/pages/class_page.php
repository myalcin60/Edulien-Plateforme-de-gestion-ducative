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
    <header>
        <?php
        include '../compenents/header.php';
        ?>
    </header>
    <div>
        <form class="form-sm" action="../../src/controllers/class_controller.php" method="post">
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
        <div class="gap-3 p-3">
            <h2>Students List</h2>
        </div>

        <div class="gap-3 p-3">
            <?= $students ?>
        </div>



    </div>
    <footer>
        <?php include '../compenents/footer.php' ?>
    </footer>

</body>

</html>