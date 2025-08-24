<?php
include_once __DIR__ . '/../repositories/class_repository.php';
include_once __DIR__ . '/../repositories/homework_repository.php';
include_once __DIR__ . '/../repositories/lesson_repository.php';



// show homeworks
function show_homeworks()
{
    $userId = $_SESSION['id'];
    $homeworks = get_homeworks_by_userId($userId);

    $liste = "<div class='table-responsive'>
        <table class='table table-striped table-hover align-middle'>
            <thead class='table-primary'>
                <tr>
                   
                    <th class='text-start'>Class</th>
                    <th class='text-start'>Lesson</th>
                    <th class='text-start'>Title</th>
                    <th class='text-start'>Description</th>
                    <th class='text-start'>File</th>
                    <th class='text-start'>Delete</th>
                    
                </tr>
            </thead>
            <tbody>";

    foreach ($homeworks as $homework) {

        $homework_id = htmlspecialchars($homework['id']);
        $title = htmlspecialchars($homework['title']);
        $description = htmlspecialchars($homework['description']);
        $class = get_class_by_classId($homework['classId']);
        $class_name = htmlspecialchars($class[0]['className']);
        $lesson = get_lesson_by_lessonId($homework['lessonId']);
        $lesson_name = htmlspecialchars($lesson[0]['lessonName']);
        $filePath = htmlspecialchars($homework['filePath']);
        $fileType = htmlspecialchars($homework['fileType']);

        // $a_mod = "
        //     <a href='../../views/pages/update_title.php?id=$homework_id' class='btn btn-warning btn-sm'>
        //         Update
        //     </a>";

        if (strlen($description) > 100) {
            $shortDesc = substr($description, 0, 100) . "...";
            $descHtml = $shortDesc . " <a href='../homework_detail.php?id=$homework_id'>Show more</a>";
        } else {
            $descHtml = $description;
        }

        if ($userId[0] == 'S') {
            $a_sup = 'Finis';
        } else {
            $a_sup = "
            <a href='../../src/controllers/homework_controller.php?id=$homework_id' homework='btn btn-danger btn-sm me-2'>
                Delete
            </a>";
        }

        if (!empty($filePath)) {
            if (in_array($fileType, ['image/jpeg', 'image/png'])) {
                $fileLink = "<img src='/edu_php/src/$filePath' style =width:150; >";
            } else {
                $fileLink = "<a href='/edu_php/src/$filePath' target='_blank'>Show file</a>";
            }
        } else {
            $fileLink = '-';
        }

        $liste .= "
            <tr>
                <td class='text-start w-25'> 
                  $class_name 
                 </td>
                <td class='text-start w-25'>
                   $lesson_name
                </td>
                <td class='text-start w-25'>
                   $title
                </td>
                <td class='text-start w-25'>
                   $descHtml
                </td>
                <td>
                   $fileLink
                </td>
                <td class='text-end w-25'>
                    <div class='form-check d-flex gap-2'>
                        <label'> $a_sup </label>
                        <input class='form-check-input' type='checkbox' name='studentIds[]' value='<?= $homework_id ?>'>               
                    </div>
                </td>
            </tr>
            
            ";
    }

    $liste .= "</tbody>
        </table>
    </div>";
    return $liste;
}
