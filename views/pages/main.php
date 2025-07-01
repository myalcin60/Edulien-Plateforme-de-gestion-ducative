<?php
$url = (isset($_GET['form']) && $_GET['form'] === 'login') ? 'login' : 'signup';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="../css/main.css" />

</head>

<body>
    <header>
        <?php
        include '../compenents/header.php';
        ?>
    </header>
    <main >
        <h2 >Welcome to our education platform</h2>
        <div class="d-flex gap-3 container-sm">
            <div id="image">
                <img src="../assets/home_page.png" alt="">
            </div>
            <div class="form container-sm">
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
</body>

</html>