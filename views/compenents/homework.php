<?php
include_once __DIR__ . '/../../src/services/service.php';

if ($_SESSION['id'][0] == 'S') {
    $homeworks = 'Homeworks';
    $create_homework = '';
    $link = './student_dashboard.php?form=homework&action=homeworks';

} else {
    $menu = $_GET['action'] ?? 'create_homework';
    $create_homework = 'Create Homework';
    $homeworks = 'Homeworks';
    $link = './teacher_dashboard.php?form=homework&action=homeworks';
}

?>

<div>
    <div class="hm-menu d-flex w-auto h-auto align-self-start gap-5 mb-5">
          <a style="text-decoration: none; font-size:large; color:var(--success-color);"
            href="<?= $link ?>">
            <?= $homeworks ?>
        </a>
        <a  style="text-decoration: none; font-size:large; color:var(--success-color);"
            href="./teacher_dashboard.php?form=homework&action=create_homework">
            <?= $create_homework ?>
        </a>   
    </div>
    <?php
    select_homework_menu($menu);
    ?>

</div>
