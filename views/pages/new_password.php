<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <?php include '../partiel/dependencies.php' ?>
</head>


<body>
    <header>
        <?php
        include '../compenents/header.php';
        ?>
    </header>
    <div class="d-flex justify-content-center vh-100">

        <div class="container ">

            <div class="row justify-content-center">

                <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">

                    <div class="p-4 rounded shadow" style="background-color: #f8f9fa;">

                        <form action="../../src/controllers/user_controller.php" method="post">

                            <h4 class="text-center mb-4">Enter your new password</h4>

                            <input type="hidden" name="action" value="reset_password">

                            <!-- New Password -->
                            <div class="mb-3">
                                <label>New password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    required
                                    minlength="4">
                            </div>

                            <!-- Confirm -->
                            <div class="mb-3">
                                <label>Confirm password</label>
                                <input
                                    type="password"
                                    name="password_confirm"
                                    class="form-control"
                                    required
                                    minlength="4"
                                    oninput="this.setCustomValidity(this.value !== password.value ? 'Passwords do not match' : '')">
                            </div>
                           <input type="hidden" name="action" value="new_password"> 
                            <button type="submit" class="btn btn-primary w-100">
                                Submit
                            </button>

                        </form>


                    </div>

                </div>

            </div>

        </div>

    </div>


</body>

</html>