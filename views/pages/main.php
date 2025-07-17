<?php
$url = (isset($_GET['form']) && $_GET['form'] === 'login') ? 'login' : 'signup';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>

</head>

<body>
 <div>
  <header>
        <?php
        include '../compenents/header.php';
        ?>
    </header>
    <main >
        
        <h2 class=" text-center text-primary my-5">Welcome to our education platform</h2>
        <div class="d-flex gap-3 container-sm">
            <div class=" d-md-block d-none rounded-2" id="image">
                <img  class="img-fluid d-md-block d-none mx-auto rounded-2" src="../assets/home_page.png" alt="image_main">
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