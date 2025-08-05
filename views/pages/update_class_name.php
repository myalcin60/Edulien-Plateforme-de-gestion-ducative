<?php
include __DIR__ . '/../../src/services/class_services.php';
$class= update_class();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>
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
    <form action="../../src/controllers/class_controller.php" method="post">
            <h2 class="p-3">Classes</h2>

            <div class="container mb-4">
                <div class="row align-items-end">
                    <div class="col-md-9 ">
                        <label for="class_name" class="form-label"  > ClassName</label>
                        <input type="text" id="class_name" name="class_name" class="form-control" placeholder="Enter class name" value="<?= $class[0]['className'] ?>">
                    </div>
                    <div class="col-md-3 d-flex w-25 ">
                        <button type="submit" class="btn btn-primary ms-3 ">Save</button>
                    </div>
                </div>
            </div>
        </form>
        <div>             
</body>

</html>



