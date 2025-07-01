<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <form action="" method="get">
        <h2>Profile</h2>
        <?php if (isset($_SESSION['first_name'])): ?>
            <p>ID : <?php echo $_SESSION['id']; ?> </p>
            <p>First Name : <?php echo $_SESSION['first_name']; ?> </p>
            <p>Last Name : <?php echo $_SESSION['last_name']; ?> </p>
            <p>Email : <?php echo $_SESSION['email']; ?> </p>
            <p>Role : <?php echo $_SESSION['role']; ?> </p>


        <?php else: ?>
            <p>Not found user.</p>
        <?php endif; ?>

    </form>

</body>

</html>