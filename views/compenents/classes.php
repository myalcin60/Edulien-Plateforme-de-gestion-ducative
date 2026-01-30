<?php
include __DIR__ . '/../../src/services/class_services.php';
include __DIR__ . '/../../src/services/lesson_services.php';

$classes = show_classes();
$student_lessons = show_student_lessons();

?>

<div>
    <div class="container-sm">
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
    </div>
    <?php if ($_SESSION['id'][0] == 'T'): ?>
        <form action="../../src/controllers/class_controller.php" method="post">
            <p class="p-3 title">Please enter the class name.</p>
            <div class="container mb-4">
                <div class="item">
                    <div class=" item  col-md-9 ">
                        <label for="class_name" class="form-label">Class</label>
                        <input type="text" id="class_name" name="class_name" class="form-control" placeholder="Enter class name">
                    </div>
                    <div class=" d-flex w-25">
                        <button type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
        <div>    
            <form action="../../src/controllers/class_controller.php" method="get">
                <div class="gap-3 p-3 ">
                    <h2> Clasess</h2>
                    <?= $classes ?>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="d-flex flex-wrap justify-content-start">
            <?php if (empty($student_lessons)): ?>
            <p class="p-3 title">You are not enrolled in any lessons yet.</p>
            <?php endif; ?>
            <?= $student_lessons ?>
        </div>
    <?php endif; ?>

</div>

