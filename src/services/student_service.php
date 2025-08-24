<?php
include __DIR__ . '/../repositories/student_repository.php';


function show_students($lessonId)
{
    $students = get_students_in_lesson($lessonId);

    $liste = "
        <div class='table-responsive'>
        <table class='table table-striped table-hover align-middle'>
            <thead class='table-primary'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class='text-end'>Actions</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($students as $student) {
        $student_id = htmlspecialchars($student['studentId']);
        $student_name = htmlspecialchars($student['studentName']);
        $student_email = htmlspecialchars($student['studentEmail']);


        $a_sup = "
            <a href='../../src/controllers/student_controller.php?studentId=$student_id&lessonId=$lessonId'' class='btn btn-danger btn-sm me-2'>
                 Delete 
            </a>";
        $liste .= "
            <tr>
                <td>$student_id</td>
                <td>$student_name</td>
                <td>$student_email</td>
                <td class='text-end w-25'>
                   $a_sup
                </td>
            </tr>";
    }

    $liste .= "
            </tbody>
        </table>
        </div>";

    return $liste;
}
// show student list with lessonId
function show_student_list($lessonId)
{
    $students = get_students_in_lesson($lessonId);
  
    $liste = "<div class='table-responsive'>
        <table class='table table-striped table-hover align-middle'>
            <thead class='table-primary'>
                <tr>
                   
                    <th class='text-start'>Name</th>
                    <th class='text-start'>Surname</th>
                    <th class='text-start'>Class</th>
                    <th class='text-start'>Lesson</th>
                    <th class='text-start'>Select</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($students as $student) {
        $classId = htmlspecialchars($student['classId']);

        $class = get_class_by_classId($classId);
        $st = get_student__from_users($student['studentEmail']);

        $id = htmlspecialchars($student['studentId']);
        $name = htmlspecialchars($student['studentName']);
        $surname = htmlspecialchars($st['last_name']);
        $className = htmlspecialchars($class[0]['className']);
        $lesson = htmlspecialchars($student['lessonName']);

        $liste .= "
            <tr>
                <td class='text-start w-25'> 
                  $name
                 </td>
                <td class='text-start w-25'>
                   $surname
                </td>
                <td class='text-start w-25'>
                   $className
                </td>
                <td class='text-start w-25'>
                   $lesson
                </td>
                <td class='text-center w-25 '>
                <input type='checkbox' name='studentIds[]' value='$id' > 
                </td>
            </tr>
            
            ";
    }

    $liste .= "</tbody>
        </table>
    </div>";
    return $liste;
}