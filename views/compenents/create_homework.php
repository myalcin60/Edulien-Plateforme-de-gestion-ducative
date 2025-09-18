<?php
include_once __DIR__ . '/../../src/services/class_services.php';
include_once __DIR__ . '/../../src/services/lesson_services.php';
include_once __DIR__ . '/../../src/services/student_service.php';
$userId = $_SESSION['id'];

$classId = $_GET['classId'] ?? null;
$classes = show_classes_in_select($classId);

$lessonId = $_GET['lessonId'] ?? null;
$lessons = show_lesons_in_select($classId, $lessonId);

$students = show_student_list($lessonId);
$studentIds = $_GET['studentIds'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homevork</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/homework.css" />
</head>

<body>
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
    <h3>CREATE HOMEWORK</h3>
    <?php if ($userId[0] == 'T'): ?>
        <div class="">
            <form method="GET">
                <div class="select-menu">
                    <h3>Select Class</h3>
                    <input type="hidden" name="form" value="homework">
                    <?= $classes ?>
                    <button type="submit">Select</button>
                </div>
            </form>
            <form method="GET">
                <div class="select-menu">
                    <h3>Select Lesson</h3>
                    <input type="hidden" name="form" value="homework">
                    <input type="hidden" name="classId" value="<?= $classId ?>">
                    <?= $lessons ?>
                    <button type="submit">Select</button>
                </div>
            </form>
            <h3>Student List</h3>
            <div class="student-list ">
                <form method="GET">
                    <input type="hidden" name="form" value="homework">
                    <input type="hidden" name="classId" value="<?= $classId ?>">
                    <input type="hidden" name="lessonId" value="<?= $lessonId ?>">
                    <?= $students ?>
                    <button type="submit">Select</button>
                </form>
            </div>
        </div>

    <?php endif; ?>
    <form action="../../src/controllers/homework_controller.php" method="POST" enctype="multipart/form-data">

        <div class="title">
            <label for="homework">Title</label>
            <input name="hm_title" id="hm_title" value="<?= htmlspecialchars($title ?? '') ?>" <?php if ($userId[0] == 'S')
                                                                                                    echo "readonly"; ?>>
        </div>
        <div class="textarea">
            <label for="homework">Homework</label>
            <textarea name="homework" id="homework" <?php if ($userId[0] == 'S')
                                                        echo "readonly"; ?>><?= htmlspecialchars($homeworkText ?? '') ?></textarea>
        </div>
        <?php if ($userId[0] == 'S'): ?>
            <div class="textarea">
                <label for="answer">Answer</label>
                <textarea name="answer" id="answer"></textarea>
            </div>
        <?php endif; ?>
        <div>
            <label>Upload File (Image / PDF)</label>
            <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf">
        </div>

        <input type="hidden" name="classId" value="<?= $classId ?>">
        <input type="hidden" name="lessonId" value="<?= $lessonId ?>">
        <?php foreach ($studentIds as $id): ?>
            <input type="hidden" name="studentIds[]" value="<?= htmlspecialchars($id) ?>">
        <?php endforeach; ?>
        <input type="hidden" name="userId" value="<?= $userId ?>">

        <button type="submit">Send</button>
    </form>
</body>

</html>