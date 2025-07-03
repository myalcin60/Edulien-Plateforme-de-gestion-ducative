<?php
include __DIR__ . '/../../src/services/class_services.php';
$classId = $_GET['id'];
$class = get_class_by_classId($classId);


$_SESSION['classId']= $classId;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Page</title>
</head>

<body>
    <header>
        <?php
        include '../compenents/header.php';
        ?>
    </header>
    <div>
        <form action="../../src/controllers/class_controller.php" method="post">
            <h2> Class Name : <?= $class[0][1] ?> </h2>
            <h2 for="classId" > Class ID : <?= $classId  ?> </h2>
            <input type="hidden" name="classId" value="<?= $classId ?> ">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>

        </form>

    </div>
    <div>
        <h2>Students List</h2>
    </div>
    <footer>
        <?php include '../compenents/footer.php'  ?>
    </footer>

</body>

</html>