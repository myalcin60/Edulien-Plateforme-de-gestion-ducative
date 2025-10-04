<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
</head>
<body>
    <h2>Students </h2>
    <form action="../../src/controllers/class_controller.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <button type="submit" class="btn btn-primary" >Save</button>

        <div>
            <h2> Students</h2>
            <div class="d-flex">
               
            </div>

        </div>
    </form>
    
</body>
</html>