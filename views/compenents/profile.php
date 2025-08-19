<?php
include __DIR__ . '/../../src/services/user_services.php';
$photo = show_user_photo($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>
    <form action="../../src/controllers/user_controller.php" method="POST" enctype="multipart/form-data">
        <div class="profile box-shadow" style="text-align:center">
            <div>
                <label for="fileInput" style="cursor:pointer; display:inline-block;">
                    <?php if ($photo): ?>
                        <img src="<?php echo $photo; ?>" alt="Profile Photo" width="150" height="150"
                            style="border-radius:25%">
                    <?php else: ?>
                        <img src="../assets/logo.jpg" alt="Avatar Profile" width="150" height="150"
                            style="border-radius:25%">
                    <?php endif; ?>
                </label>

                <!-- hidden file input -->
                <input type="file" name="profile_photo" accept="image/*" id="fileInput" style="display:none">

                <button type="submit">Upload</button>
            </div>


            <input type="hidden" name="userId" value="<?= $_SESSION['id'] ?>">
            <h2>Welcome Mr/Ms <?php echo $_SESSION['first_name'], ' ', $_SESSION['last_name']; ?></h2>
        </div>

    </form>



    <form action="../pages/teacher_dashboard.php" method="get">

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
                    <p>Gender : </p>
                    <div class="flex gap-1">
                        <label> Male </label>
                        <input type="radio" name="gender" value="male">

                        <label>Female </label>
                        <input type="radio" name="gender" value="female">
                    </div>

                </div>




            <?php else: ?>
                <p>Not found user.</p>
            <?php endif; ?>
        </div>


    </form>

    <div>
        <a href="./teacher_dashboard.php?form=update_profile">
            <button class="profil-updt">Update</button>
        </a>
    </div>

</body>

</html>