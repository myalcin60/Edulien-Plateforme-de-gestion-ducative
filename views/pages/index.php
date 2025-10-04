<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/index.css" />
</head>

<body>

    <header>
        <?php
        include '../compenents/header.php';
        ?>
    </header>
    <main>
        <div class="flex container-sm section_1 ">
            <div>
                <h1 class=" my-5">Meet EDULIEN, the Digital Face of Education</h1>
                <p>Digital classrooms specially designed for teachers and students</p>

                <div class='item_btn'>
                    <a href="./main.php?form=login" class="btn btn-primary">Explore Edulien</a>

                </div>


            </div>

            <div style="max-width:350px;" class="bg-white  rounded-2 form container-sm  " id="image">
                <img class="img-fluid d-md-block d-none mx-auto rounded-2" src="../assets/imageHome.png" alt="image_main">

            </div>
        </div>
        <div class="specialties ">
            <h2>Specialties</h2>
            <div class="flex section_2 ">
                <div class="box-shadow ">
                    <img src="../assets/teacher.jpg" alt="teacher">
                    <h3>Teacher panel </h3>
                    <p>Digitalize your lessons and communicate more effectively with your students.</p>

                </div>
                <div class="box-shadow ">
                    <img src="../assets/school.jpg" alt="student">
                    <h3>Student Tracking</h3>
                    <p>Monitor each student's progress individually</p>

                </div>
                <div class="box-shadow ">
                    <img src="../assets/home_page.png" alt="materials">
                    <h3>Homework & Materials</h3>
                    <p>Ease of digital assignment submission and resource sharing.</p>

                </div>
            </div>

        </div>

        <div class="section_3 max-w-6xl  px-6 py-12 flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1">
                <h3 class="text-2xl font-semibold mt-5">Teaching is easier with Edulien</h3>
                <p class="mt-3 text-gray-600">Eduline simplifies classroom management and accelerates teacher-student interaction. Set up your project today and leave the rest to rest.</p>
                <div class="mt-6">
                    <a href="../pages/main.php?form=signup" class="inline-block px-6 py-3 bg-indigo-600 text-light rounded-lg bg-dark p-3">Try Now</a>
                </div>
            </div>

    </main>
    <footer>
        <?php include '../compenents/footer.php'  ?>
    </footer>


</body>

</html>