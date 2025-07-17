<?php
include __DIR__ . '/../repositories/class_repository.php';

function show_classes()
{
    $classes = get_classes($_SESSION['id']);
    $liste = "<ul class='list-group'>";

    foreach ($classes as $class) {

        $class_id = htmlspecialchars($class[0]);
        $class_name = htmlspecialchars($class[1]);

        $class_link = "../../views/pages/class_page.php?id=$class_id";
        $a_sup = "
            <a href='../../src/controllers/class_controller.php?id=$class_id' class='btn btn-danger btn-sm me-2'>
                Supprimer
            </a>";

        $a_mod = "
            <a href='#?id=$class_id' class='btn btn-warning btn-sm'>
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
            <div class='card mb-4 mx-2'  style='width: 18rem; height:10rem; display:inline-block; vertical-align:top;background-color: $bgColor;'>
                <div class='card-body'>
                    <a href='$class_link' class='card-link'> <h5 class='card-title'>$class_name</h5></a>
                    <h6 class='card-subtitle mb-2 text-body-secondary'>$teacher_name  $teacher_lastName</h6>    
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