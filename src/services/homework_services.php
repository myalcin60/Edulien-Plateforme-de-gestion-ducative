<?php
include_once __DIR__ . '/../repositories/class_repository.php';
include_once __DIR__ . '/../repositories/homework_repository.php';
include_once __DIR__ . '/../repositories/lesson_repository.php';


// show homeworks
function show_homeworks()
{
    $userId = trim($_SESSION['id']);
    $homeworks = get_homeworks_by_userId($userId) ?? [];

    $liste = "<div class='table-responsive'>
        <table class='table table-striped table-hover align-middle'>
            <thead class='table-primary'>
                <tr>
                    <th class='text-start'>No</th>
                    <th class='text-start'>Class Name</th>
                    <th class='text-start'>Lesson Name</th>
                    <th class='text-start'>Title</th>
                    <th class='text-start'>Description</th>
                    <th class='text-start'>File</th>
                    <th class='text-start'>Answer</th>";

    if (trim($userId[0]) == 'T') {
        $liste .= "
                    <th class='text-start'>Select</th>";
    }
    $liste .= "
                </tr>
                
            </thead>
            <tbody>";
    $no = 1;

    $path = basePath();

    foreach ($homeworks as $homework) {

        $homework_id = htmlspecialchars(trim($homework['id']));
        $title = htmlspecialchars(trim($homework['title']));
        $description = htmlspecialchars(trim($homework['description']));

        $class = get_class_by_classId(trim($homework['classId']));

        $class_name = htmlentities($class[0]['className']);
        $lesson = get_lesson_by_lessonId($homework['lessonId']);
        $lesson_name = htmlspecialchars($lesson[0]['lessonName']);
        $filePath = htmlentities($homework['filePath'] ?? '');
        $fileType = htmlentities($homework['filePath'] ?? '');
       

        $answerLink = " <a href='../../views/pages/answer_hm.php?id=$homework_id' class='btn btn-warning btn-sm'> Answer </a>";

        // $a_mod = "
        //     <a href='../../views/pages/update_title.php?id=$homework_id' class='btn btn-warning btn-sm'>
        //         Update
        //     </a>";

        if (strlen($description) > 100) {
            $shortDesc = substr($description, 0, 100) . "...";
            $descHtml = $shortDesc . " <a class='text_dark' style='color:blue' href='../homework_detail.php?id=$homework_id'>Show more</a>";
        } else {
            $descHtml = $description;
        }

        if ($userId[0] == 'S') {
            $a_sup = 'Finis';
            $answerLink = " <a href='../../views/pages/answer_hm.php?id=$homework_id' class='btn btn-warning btn-sm'> Answer </a>";
        } else {
            $a_sup = "
            <a href='../../src/controllers/homework_controller.php?id=$homework_id' homework='btn btn-danger btn-sm me-2'>
                Delete
            </a>";
        }

        if (!empty($filePath)) {
            if (in_array($fileType, ['image/jpeg', 'image/png'])) {
                $fileLink = "<img src='$path/$filePath' style =width:150; >";
                // $fileLink = "<img src='/$filePath' style =width:150; >"; //---> for deployment
            } else {
                $fileLink = "<a style='color:black;' href='$path/$filePath' target='_blank'>Show file</a>";
                // $fileLink = "<a style='color:black;' href='/$filePath' target='_blank'>Show file</a>"; // ---> for deployment
            }
        } else {
            $fileLink = '-';
        }

        $liste .= "
    <tr>
        <td class='text-start w-10'> 
            $no 
        </td>
        <td class='text-start w-20'> 
            $class_name 
        </td>
        <td class='text-start w-20'>
            $lesson_name
        </td>
        <td class='text-start w-20'>
            $title
        </td>
        <td class='text-start w-30' style='word-wrap: break-word; white-space: normal; max-width: 200px;'>
            $descHtml
        </td>
        <td>
            $fileLink
        </td>
        <td>
            $answerLink
        </td>";
        if (trim($userId[0]) == 'T') {
            $liste .= "
        <td class='text-end w-30'>
            <div class='form-check d-flex gap-3'>
                <input class='form-check-input' type='checkbox' name='homeworkIds[]' value='$homework_id'>               
            </div>
        </td>";
        }

        $liste .= "
        </tr>
                ";

        $no++;
    }

    $liste .= "</tbody>
        </table>
    </div>";
    return $liste;
}

//show one homework
function show_homework($id)
{
    $homework = get_homework($id);
    $homework_id = htmlspecialchars($homework['id']);
    $title = htmlspecialchars($homework['title']);
    $description = htmlspecialchars($homework['description']);

    $class = get_class_by_classId($homework['classId']);

    $class_name = htmlentities($class[0]['className']);
    $lesson = get_lesson_by_lessonId($homework['lessonId']);
    $lesson_name = htmlspecialchars($lesson[0]['lessonName']);
    $filePath = htmlentities($homework['filePath'] ?? '');
    $fileType = htmlentities($homework['filePath'] ?? '');

    if (strlen($description) > 100) {
        $shortDesc = substr($description, 0, 100) . "...";
        $descHtml = $shortDesc . " <a class='text_dark' style='color:blue' href='../homework_detail.php?id=$homework_id'>Show more</a>";
    } else {
        $descHtml = $description;
    }
    if (!empty($filePath)) {
        if (in_array($fileType, ['image/jpeg', 'image/png'])) {
                $fileLink = "<img src='/edu_php/$filePath' style =width:150; >";
                // $fileLink = "<img src='/$filePath' style =width:150; >"; //---> for deployment
            } else {
                $fileLink = "<a style='color:black;' href='/edu_php/$filePath' target='_blank'>Show file</a>";
                // $fileLink = "<a style='color:black;' href='/$filePath' target='_blank'>Show file</a>"; //---> for deployment
            }
    } else {
        $fileLink = '-';
    }

    $liste = "<div class='table-responsive'>
        <table class='table table-striped table-hover align-middle'>
            <thead class='table-primary'>
                <tr>                   
                    <th class='text-start'>Class Name</th>
                    <th class='text-start'>Lesson Name</th>
                    <th class='text-start'>Title</th>
                    <th class='text-start'>Description</th>
                    <th class='text-start'>File</th>
                    <th class='text-start'>Select</th>                   
                </tr>
            </thead>
            <tbody>
            <tr>        
        <td class='text-start w-20'> 
            $class_name 
        </td>
        <td class='text-start w-20'>
            $lesson_name
        </td>
        <td class='text-start w-20'>
            $title
        </td>
        <td class='text-start w-30' style='word-wrap: break-word; white-space: normal; max-width: 200px;'>
            $descHtml
        </td>
        <td>
            $fileLink
        </td>
         <td class='text-end w-0'>
            <div class='form-check d-flex gap-3'>
                <input class='form-check-input' type='checkbox' name='homeworkIds[]' value='$homework_id'>               
            </div>
        </td>            
            </tbody>
        </table>
    </div>   
            ";
    return $liste;
}

// show answers for homework by student
function show_homework_answers($homeworkId, $studentId)
{
    $answers = get_homework_answers($homeworkId, $studentId);

    $liste = "<div class='table-responsive'>
        <table class='table table-striped table-hover align-middle'>
            <thead class='table-primary'>
                <tr>
                    <th class='text-start'>No</th>
                    <th class='text-start'>Description</th>
                    <th class='text-start'>File</th>
                    <th class='text-start'>Created At</th>
                    <th class='text-start'>Action</th>
                </tr> 
            </thead>
            <tbody>";

    $no = 1;
    foreach ($answers as $answer) {

        $description = htmlspecialchars($answer['description']);
        $filePath = htmlentities($answer['filePath'] ?? '');
        $fileType = htmlentities($answer['fileType'] ?? '');
        $date = new DateTime($answer['created_at']);
        $created_at = $date->format('d-m-Y');
        $answer_Id = htmlspecialchars($answer['id']);

        if (!empty($filePath)) {
           if (in_array($fileType, ['image/jpeg', 'image/png'])) {
                $fileLink = "<img src='/edu_php/$filePath' style =width:150; >";
                // $fileLink = "<img src='/$filePath' style =width:150; >"; //---> for deployment
            } else {
                $fileLink = "<a style='color:black;' href='/edu_php/$filePath' target='_blank'>Show file</a>";
                // $fileLink = "<a style='color:black;' href='/$filePath' target='_blank'>Show file</a>"; //---> for deployment
            }
        } else {
            $fileLink = '-';
        }

          $a_sup = "
            <a href='../../src/controllers/homework_controller.php?id=$answer_Id' class='btn btn-danger btn-sm me-2'>
                Delete
            </a>";

        $liste .= " 
    <tr></tr>
        <td class='text-start w-10'> 
            $no 
        </td>
        <td class='text-start w-50'>
            $description    
        </td>
        <td>
            $fileLink   
        </td>
        <td class='text-start w-20'>
            $created_at
        </td>
         <td class='text-start w-20'>
            $a_sup
        </td>
    </tr>
                ";

        $no++;
    }
    $liste .= "</tbody>
        </table>
    </div>";
    return $liste;
}
// show all aswers for homework by teacher

function show_answer($id, $teacherId)
{
    $homeworkId =  get_homeworkId_by_id($id);

    $answers = get_answers($homeworkId, $teacherId);

    $liste = "<div class='table-responsive'>
        <table class='table table-striped table-hover align-middle'>
            <thead class='table-primary'>
                <tr>
                    <th class='text-start'>No</th>
                    <th class='text-start'>Name</th>
                    <th class='text-start'>Description</th>
                    <th class='text-start'>File</th>
                    <th class='text-start'>Created At</th>
                    <th class='text-start'>Select</th>
                    
                </tr> 
            </thead>
            <tbody>";
    $no = 1;
    foreach ($answers as $answer) {
        $name = htmlspecialchars($answer['first_name']);
        $lastname = htmlspecialchars($answer['last_name']);
        $description = htmlspecialchars($answer['description']);
        $filePath = htmlentities($answer['filePath'] ?? '');
        $fileType = htmlentities($answer['fileType'] ?? '');

        $date = new DateTime($answer['created_at']);
        $created_at = $date->format('d-m-Y');


        if (!empty($filePath)) {
           if (in_array($fileType, ['image/jpeg', 'image/png'])) {
                $fileLink = "<img src='/edu_php/$filePath' style =width:150; >";
                // $fileLink = "<img src='/$filePath' style =width:150; >"; //---> for deployment
            } else {
                $fileLink = "<a style='color:black;' href='/edu_php/$filePath' target='_blank'>Show file</a>";
                // $fileLink = "<a style='color:black;' href='/$filePath' target='_blank'>Show file</a>"; //---> for deployment
            }
        } else {
            $fileLink = '-';
        }
         

        $liste .= " 
    <tr></tr>
        <td class='text-start w-10'> 
            $no 
        </td>
       <td class='text-start w-10'>
    $name   $lastname 
    </td>
        <td class='text-start w-50'>
            $description    
        </td>
        <td>
            $fileLink   
        </td>
        <td class='text-start w-20'>
            $created_at
        </td>
         <td class='text-start w-20'>  
            <div class='form-check d-flex gap-3'>
                <input class='form-check-input' type='checkbox' name='homeworkIds[]' value=''>              
            </div>
        </td>
    </tr>
                ";

        $no++;
    }
    $liste .= "</tbody>
        </table>
    </div>";
    return $liste;
}
