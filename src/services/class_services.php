<?php
include __DIR__ . '/../repositories/class_repository.php';

function update_class(){
 $class=get_class_by_classId(htmlspecialchars($_GET['id']));
 return $class;
}

// show lessons
function show_lessons()
{   
    $lessons = get_lessons_with_classId($_SESSION['classId']);
    $liste = "<ul class='list-group'>";

    foreach ($lessons as $lesson) {

        $lessonId = htmlspecialchars($lesson['lessonId']);
        $lessonName = htmlspecialchars($lesson['lessonName']);

        $lessonLink = "../../views/pages/lesson_page.php?id=$lessonId";
        $a_sup = "
            <a href='../../src/controllers/class_controller.php?id=$lessonId' class='btn btn-danger btn-sm me-2'>
                Delete
            </a>";

        $a_mod = "
            <a href='../../views/pages/update_lessonName.php?id=$lessonId' class='btn btn-warning btn-sm'>
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
   
// function show_classes()
// {
//     $classes = get_classes($_SESSION['id']);
//     $liste = "  <div class='table-responsive'>
//         <table class='table table-striped table-hover align-middle'>
//             <thead class='table-primary'>
//                 <tr>
                  
//                     <th>Class Name</th>
//                     <th class='text-end'>Delete</th>
//                     <th class='text-end'>Update</th>
//                 </tr>
//             </thead>
//             <tbody>";

//     foreach ($classes as $class) {

//         $class_id = htmlspecialchars($class[0]);
//         $class_name = htmlspecialchars($class[1]);

//         $class_link = "../../views/pages/class_page.php?id=$class_id";
//         $a_sup = "
//             <a href='../../src/controllers/class_controller.php?id=$class_id' class='btn btn-danger btn-sm me-2'>
//                 Delete
//             </a>";

//         $a_mod = "
//             <a href='../../views/pages/update_class_name.php?id=$class_id' class='btn btn-warning btn-sm'>
//                 Update
//             </a>";

//        $liste .= "
//             <tr>
//                 <td> <a href='$class_link' style='text-decoration: none; color: inherit; flex-grow: 1;'>
//                   $class_name
//                  </a></td>
               
//                 <td class='text-end w-25'>
//                    $a_mod
//                 </td>
//                 <td class='text-end w-25'>
//                    $a_sup
//                 </td>
//             </tr>";
//     }

//     $liste .= "</ul>";
//     return $liste;
// }

function show_classes()
{
    $classes = get_classes($_SESSION['id']);
    $liste = "<ul class='list-group'>";

    foreach ($classes as $class) {

        $class_id = htmlspecialchars($class[0]);
        $class_name = htmlspecialchars($class[1]);

        $class_link = "../../views/pages/class_page.php?classId=$class_id";
        $a_sup = "
            <a href='../../src/controllers/class_controller.php?id=$class_id' class='btn btn-danger btn-sm me-2'>
                Delete
            </a>";

        $a_mod = "
            <a href='../../views/pages/update_class_name.php?id=$class_id' class='btn btn-warning btn-sm'>
                Update
            </a>";

        $liste .= "
            <li class='list-group-item d-flex justify-content-between align-items-center'>
                 <input type='hidden' value='$class_id'>
                <a href='$class_link' style='text-decoration: none; color: inherit; flex-grow: 1;'>
                  $class_name
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

function show_class_student()
{
    if ($_SESSION['id']) {
        $classes = get_classes_for_student($_SESSION['id']);
        
        $result='';
        
       
        foreach ($classes as $class) {

            $class_id = htmlspecialchars($class['classId']);
            $class_name = htmlspecialchars($class['className']);
            $teacher_name = htmlspecialchars($class['first_name']);
            $teacher_lastName=htmlspecialchars($class['last_name']);
            
            $bgColor = random_color();
            $class_link = "#";
            $result.= " 
            <div class='card mb-4 mx-2'  style='width: 18rem; height:10rem; display:inline-block; vertical-align:top;background-color: $bgColor; color:white;'>
                <div class='card-body' >
                    <a href='$class_link' class='card-link'> <h5 class='card-title'>$class_name</h5></a>
                    <h6 style='color:white;'>$teacher_name  $teacher_lastName</h6>    
                </div>
            </div>";           
        }
        return $result;
     
    } else {
        return 'error';
    }
}
function random_color() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}