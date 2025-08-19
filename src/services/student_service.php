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
                Supprimer
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
