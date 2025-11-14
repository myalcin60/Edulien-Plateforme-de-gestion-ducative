<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edulien, Provides homework sharing and digital library for teachers and students.">
    <title>Edulien - Digital Education Platform</title>
</head>

<body>
    <div class="left-menu box-shadow ">

        <?php if ($_SESSION['id'][0] == 'T') : ?>
            <a class="menu" style="text-decoration: none;" href="./teacher_dashboard.php?form=profile">
                <button class="left-menu-button"> <?= $profile ?></button>
            </a>
            <a style="text-decoration: none;" href="./teacher_dashboard.php?form=classes">
                <button class="left-menu-button"> <?= $classes ?></button>
            </a>
            <a style="text-decoration: none;" href="./teacher_dashboard.php?form=homework">
            <button class="left-menu-button"> <?= $homework ?></button>
        </a>
        <?php else : ?>
            <a class="menu" style="text-decoration: none;" href="./student_dashboard.php?form=profile">
                <button class="left-menu-button"> <?= $profile ?></button>
            </a>
            <a style="text-decoration: none;" href="./student_dashboard.php?form=classes">
                <button class="left-menu-button"> <?= $classes ?></button>
            </a>
            <a style="text-decoration: none;" href="./student_dashboard.php?form=homework">
            <button class="left-menu-button"> <?= $homework ?></button>
        </a>
        <?php endif; ?>
        
    </div>
</body>

</html>