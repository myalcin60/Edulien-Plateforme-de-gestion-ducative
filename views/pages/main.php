<?php
$url = (isset($_GET['form']) && $_GET['form'] === 'login') ? 'login' : 'signup';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>>

</head>

<body>
    <div class="wrapper">
        <header>
            <?php
            include '../compenents/header.php';
            ?>
        </header>
        <main>
            <div class="d-flex gap-3 container-sm">
                <div class=" d-md-block d-none rounded-2" id="image">
                    <img class="img-fluid d-md-block d-none mx-auto rounded-2" src="../assets/okul.png" alt="image_main">
                </div>

                <div style="max-width:350px;" class="bg-white box-shadow rounded-2 form container-sm border ">
                    <?php
                    if ($url === 'signup') {
                        include '../compenents/signup_form.php';
                    } else {
                        include '../compenents/login_form.php';
                    }

                    ?>
                </div>
            </div>

        </main>
        <footer>
            <?php include '../compenents/footer.php'  ?>
        </footer>
    </div>


</body>

</html>