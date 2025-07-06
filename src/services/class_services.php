<?php
include __DIR__ . '/../repositories/class_repository.php';

function show_classes()
{
    $classes = get_classes($_SESSION['id']);
    $liste = "<ul class='list-group'>";

    foreach ($classes as $class) {

        $class_id = htmlspecialchars($class[0]);
        $class_name = htmlspecialchars($class[1]);

        $class_link = "../../views/pages/class_page.php?id=$class_id"; // detay sayfası örnek
        $a_sup = "
            <a href='../../controllers/delete_class.php?id=$class_id' style='text-decoration: none;'>
                <button style='background: var(--primary);
                                border-radius:5px;
                                margin-right: 5px;
                                border: none;
                                color: white;
                                width:100px;'>
                    Supprimer
                </button>
            </a>";

        $a_mod = "
            <a href='../../views/pages/update_class.php?id=$class_id' style='text-decoration: none;'>
                <button  style='background:var(--primary);
                                border-radius:5px;
                                border: none;
                                color: white;
                                width:100px;'>
                    Update
                </button>
            </a>";

        $liste .= "
            <li class='list-group-item d-flex justify-content-between align-items-center'>
                <a href='$class_link' style='text-decoration: none; color: inherit; flex-grow: 1;'>
                    $class_id - $class_name
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
        $liste = "<ul class='list-group'>";

        foreach ($classes as $class) {
          
            $class_id = htmlspecialchars($class['classId']);
            $class_name = htmlspecialchars($class['className']);

            $class_link = "../../views/pages/class_page.php?id=$class_id"; 

       
            $liste .= "
            <li class='list-group-item d-flex justify-content-between align-items-center'>
                <a href='$class_link' style='text-decoration: none; color: inherit; flex-grow: 1;'>
                    $class_id - $class_name
                </a>
            </li>";
        }

        $liste .= "</ul>";
        return $liste;
    } else {
        return 'error';
    }
}
