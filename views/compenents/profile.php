<?php
include __DIR__ . '/../../src/services/user_services.php';
include_once __DIR__ . '/../../src/repositories/user_repository.php';
$photo = show_user_photo($_SESSION['id']);
$user = get_user_by_id($_SESSION['id']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/profile.css" />
</head>

<body>
    <form action="../../src/controllers/user_controller.php" method="post" enctype="multipart/form-data">
        <div class="profile box-shadow" style="text-align:center">
            <div>
                <label for="fileInput" style="cursor:pointer; display:inline-block;">
                    <?php if ($photo): ?>
                        <img src="<?php echo $photo; ?>" alt="Profile Photo" width="150" height="150"
                            style="border-radius:25%">
                    <?php else: ?>
                        <img src="../assets/account.png" alt="Avatar Profile" width="150" height="150"
                            style="border-radius:25%">
                    <?php endif; ?>
                </label>
                <!-- hidden file input -->
                <input type="file" name="profile_photo" accept="image/*" id="fileInput" style="display:none">
                <button type="submit">Save</button>
            </div>
            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
            <?php if ($user['gender'] == 'male') : ?>
                <h2>Welcome Mr <?php echo $user['first_name'], ' ', $user['last_name']; ?></h2>
            <?php elseif ($user['gender'] == 'female'): ?>
                <h2>Welcome Mss <?php echo $user['first_name'], ' ', $user['last_name']; ?></h2>
            <?php else: ?>
                <h2>Welcome <?php echo $user['first_name'], ' ', $user['last_name']; ?></h2>
            <?php endif; ?>
        </div>
    </form>
    <form action="../../src/controllers/profile_controller.php" method="post">
        <div class="profile  box-shadow ">
            <?php if (isset($user['id'])): ?>
                <div>
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <p>ID <?php echo htmlspecialchars($user['id']); ?> </p>
                </div>
                <div>
                    <label>Last Name </label>
                    <input type="text" name="last_name" value=" <?php echo htmlspecialchars($user['last_name']); ?>">
                </div>
                <div>
                    <label>First Name </label>
                    <input type="text" name="first_name" value=" <?php echo htmlspecialchars($user['first_name']); ?>">
                </div>
                <div>
                    <label for="email">Email </label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>

                <div>
                    <?php if ($user['id'][0] == 'T') : ?>
                        <label for="specialization">Specialization </label>
                        <input type="text" name="specialization" value="<?php echo htmlspecialchars($user['specialization'] ?? ''); ?>">
                    <?php else : ?>
                        <label for="specialization">Class </label>
                        <input type="text" name="specialization" value="<?php echo htmlspecialchars($user['specialization'] ?? ''); ?>">
                    <?php endif; ?>
                </div>


                <div>
                    <p>Gender </p>
                    <div class="flex gap-1">
                        <label> Male </label>
                        <input class="gender" type="radio" name="gender" value="male"
                            <?php if ($user['gender'] === 'male') echo 'checked'; ?>>
                        <label>Female </label>
                        <input class="gender" type="radio" name="gender" value="female"
                            <?php if ($user['gender'] === 'female') echo 'checked'; ?>>
                    </div>
                </div>
            <?php else: ?>
                <p>Not found user.</p>
            <?php endif; ?>
        </div>
        <div>
            <button class="profil-updt" type="submit">Update</button>
        </div>
    </form>
    <form action="../../src/controllers/profile_controller.php" method="GET">
        <div>
            <button class="profil-updt" type="submit">Delete</button>
        </div>
    </form>

</body>

</html>