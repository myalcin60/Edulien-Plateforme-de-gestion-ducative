<?php

include_once __DIR__ . '/../repositories/lesson_repository.php';

// show lessons for teacher
function show_lessons($classId)
{
    $_SESSION['classId'] = $classId;
    $lessons = get_lessons_with_classId($classId);
    $liste = "<ul class='list-group'>";

    foreach ($lessons as $lesson) {

        $lessonId = htmlspecialchars($lesson['lessonId']);
        $lessonName = htmlspecialchars($lesson['lessonName']);

        $lessonLink = "../../views/pages/lesson_page.php?id=$lessonId";
        $a_sup = "
            <a href='../../src/controllers/lesson_controller.php?classId=$classId&id=$lessonId' class='btn btn-danger btn-sm me-2'>
                DELETE
            </a>";
        $a_mod = "
            <a href='../../views/pages/update_lesson_name.php?classId=$classId&id=$lessonId' class='btn btn-warning btn-sm'>
                Update
            </a>";

        $liste .= "
            <li class='list-group-item d-flex justify-content-between align-items-center'>
                 <input type='hidden' value='$lessonId'>
                <a href='$lessonLink' style='text-decoration: none; color: inherit; flex-grow: 1;'>
                  $lessonName
                </a>
                <div class='d-flex gap-3 mb-1'>
                    $a_sup
                    $a_mod
                </div>
            </li>";
    }

    $liste .= "</ul>";
    return $liste;
}
// show lessons in the student page
function show_student_lessons()
{
    if ($_SESSION['id'][0] == 'S') {
        $lessons = get_student_lessons($_SESSION['id']);

        $result = '';
        foreach ($lessons as $lesson) {

            $lesson_id = htmlspecialchars($lesson['lessonId']);
            $les= get_lesson_by_lessonId($lesson_id);

            $lesson_name = htmlspecialchars($les[0]['lessonName']);
            $teacher_name = htmlspecialchars($lesson['first_name']);
            $teacher_lastName = htmlspecialchars($lesson['last_name']);
            $className = htmlspecialchars($lesson['className']);

            $bgColor = random_color();
            $lesson_link = "#";
            $result .= " 
            <div class='card mb-4 mx-2'  style='width: 18rem; height:10rem; display:inline-block; vertical-align:top;background-color: $bgColor; color:white; padding: 2%;'>
                <div lesson='card-body' >
                    <h4>$className </h6>
                    <a href='$lesson_link' lesson='card-link'> <h5 lesson='card-title'>$lesson_name</h5></a>
                    <h6 style='color:white;'>$teacher_name  $teacher_lastName</h6>    
                </div>
            </div>";
        }
        return $result;

    } else {

        return 'error';
    }
}
function random_color()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

// update lesson name

function update_lesson_name()
{
    $lesson = get_lesson_by_lessonId(htmlspecialchars($_GET['id']));

    return $lesson;
}

// show lessons in select
function show_lesons_in_select($classId, $selectedLessonId = null)
{
    $lessons = get_lessons_with_classId($classId);

    // "SELECT CLASS" yalnızca hiçbir class seçilmemişse selected
    $selectOptionSelected = ($selectedLessonId === null) ? "selected" : "";
    $liste = "<select name='lessonId'>
                 <option value='' disabled $selectOptionSelected>SELECT LESSON</option> ";
    foreach ($lessons as $lesson) {

        $lesson_id = htmlspecialchars($lesson['lessonId']);
        $lesson_name = htmlspecialchars($lesson['lessonName']);
        $selected = ($lesson_id == $selectedLessonId) ? "selected" : "";
        $liste .= " <option value='$lesson_id' $selected>$lesson_name</option> ";
    }
    $liste .= "</select>";
    return $liste;
}
