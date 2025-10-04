<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>
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
    <form action="../../src/controllers/user_controller.php" method="get">
        <h2>Login</h2>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary" style="background-color:#3ABCF8; border-color:#3ABCF8;">Submit</button>

    </form>
    <div class="mt-5 text-dark text-center">
        <a href="./main.php?form=signup" class="text-dark">Create an account</a>
    </div>



</body>

</html