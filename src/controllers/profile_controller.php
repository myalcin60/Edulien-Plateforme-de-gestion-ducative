<?php

include __DIR__ . '/../repositories/user_repository.php';
include __DIR__ . '/../services/service.php';
include_once __DIR__ . '/../../views/partiel/toast.php';

// update profole
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "dashboard.php") and $_SERVER['REQUEST_METHOD'] === 'POST') {

    update_user_profile($_POST['id'], $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['gender']);
   
    header("location: ../../views/pages/teacher_dashboard.php?form=profile");
    die();
}
