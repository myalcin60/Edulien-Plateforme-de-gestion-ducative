<?php
include __DIR__ . '/../repositories/class_repository.php';


function update_class()
{
    $class = get_class_by_classId(htmlspecialchars($_GET['id']));
    return $class;
}

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

function show_classes_in_select($selectedClassId = null)
{
    $classes = get_classes($_SESSION['id']);
    $selectOptionSelected = ($selectedClassId === null) ? "selected" : "";

    $liste = "<select name='classId'>
                <option value='' disabled $selectOptionSelected>SELECT CLASS</option>";

    foreach ($classes as $class) {
        $class_id = htmlspecialchars($class[0]);
        $class_name = htmlspecialchars($class[1]);
        $selected = ($class_id == $selectedClassId) ? "selected" : "";
        $liste .= "<option value='$class_id' $selected>$class_name</option>";
    }

    $liste .= "</select>";
    return $liste;
}
