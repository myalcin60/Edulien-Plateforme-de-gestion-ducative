<?php session_start(); ?>

<div class="container mt-5">
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
    <form action="../../src/controllers/user_controller.php" method="post">
        <h2>Login</h2>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3" style='color:var( --accent-secondary);'>
             <a style='color:var( --accent-secondary);' href="../pages/update_password.php">I forget my password</a>
        </div>
        <input type="hidden" name="action" value="login">
        <button type="submit" class="btn btn-primary mb-3" style="background-color:#067BB1; border-color:#067BB1;">Submit</button>
        <a style='color:var( --accent-secondary);' href="./auth.php?form=signup">Create an account</a>
    </form>

</div>