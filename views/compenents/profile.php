<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body >
    <form action="../pages/teacher_dashboard.php" method="get">
        <div class="profile box-shadow">
            <div >
                <img src="../assets/teacher.jpg" alt="">
            </div>
            <h2>PROFILE</h2>
        </div>
        <div class="profile  box-shadow ">
            <?php if (isset($_SESSION['first_name'])): ?>
                <div class="">
                    <p>ID : <?php echo $_SESSION['id']; ?> </p>
                    <!-- <p>Role : <?php echo $_SESSION['role']; ?> </p> -->
                    <p>Email : <?php echo $_SESSION['email']; ?> </p>

                </div>
                <div>
                    <p>Last Name : <?php echo $_SESSION['last_name']; ?> </p>

                </div>
                <div>
                    <p>First Name : <?php echo $_SESSION['first_name']; ?> </p>
                </div>
                <div>
                    <button class="profil-updt">Update</button>
                </div>



            <?php else: ?>
                <p>Not found user.</p>
            <?php endif; ?>
        </div>


    </form>
</body>

</html>