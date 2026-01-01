<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css" />
    <?php include '../partiel/dependencies.php' ?>
</head>

<body>
    <header>
        <?php
        include '../compenents/header.php';
        ?>
    </header>
    <main>
        <div class="container-sm my-5 d-block d-md-flex gap-5 justify-content-center align-items-start px-5">
            <div class="w-100 w-md-50">
                <h1>Contact Us</h1>
                <p>If you have any questions, feedback, or need assistance, please don't hesitate to reach out to us. We're here to help!</p>
            </div>

            <form class="mt-4 shadow p-4 rounded w-100 w-md-50" action="#" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-3" style="background-color:#067BB1; border-color:#067BB1;">Submit</button>
            </form>


    </main>
    <footer>
        <?php include '../compenents/footer.php'  ?>
    </footer>

</body>

</html>