<?php 
include __DIR__. '/../repositories/class_repository.php';

function show_classes(){
    $classes = get_classes($_SESSION['id']);
    $liste = "<ul>";
  foreach ($classes as $key => $class) {

    $a_sup = "
        <a style='text-decoration: none;' href='../../views/pages/teacher_dashboard.php?form=classes,id=$class[0]'>
        <button style='background: var(--primary);
                                border-radius:5px;                                
                                margin-bottom:10px;
                                border: none;
                                color:white;
                                '
        >
        Supprimer
        </button>
        </a> ";

    $a_mod = "
        <a style='text-decoration: none;' href='../../views/pages/teacher_dashboard.php?form=classes,id=$class[0]' >
        <button style='background:  var(--primary);
                                border-radius:5px;                               
                                margin-left:10px;
                                border: none;
                                color:white;'
        >
        Update
   </button>
        </a> ";

    $liste .= "<li class='d-flex justify-content-between'>$class[1] <div>$a_sup $a_mod </div> </li>";
  }
  $liste .= "</ul>";
  return $liste;
}