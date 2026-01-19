<?php 
session_start(); 
?>

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
        <h2>Sign Up</h2>
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label" name="role">Role</label>
            <select class="form-select" aria-label="Student" name="role">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
        </div> 
        <input type="hidden" name="action" value="signup">
        <button type="submit" class="btn btn-primary mb-3" >Register</button>
        <a style='color:var( --accent-secondary);' href="./auth.php?form=login">I already have an account. Login</a>
    </form>
</div>

