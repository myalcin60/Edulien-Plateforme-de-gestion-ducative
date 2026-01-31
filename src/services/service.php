<?php

if (!function_exists('basePath')) {
    function basePath() {
        if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'localhost') {
            return '/edu_php';
        } else {
            return '';
        }
    }
}


function create_id($role)
{
    $id = '';
    if ($role == 'student') {
        $id = 'S_' . random_int(10000, 100000);
    } else {
        $id = 'T_' . random_int(10000, 100000);
    }
    return $id;
}

function uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

function select_menu($menu)
{
    try {
        $profile = 'profile';
        $classes = 'classes';
        $homework = 'homework';
        switch ($menu) {
            case $profile:
                include '../../views/compenents/profile.php';
                break;
            case $classes:
                include '../../views/compenents/classes.php';
                break;
            case $homework:
                include '../../views/compenents/homework.php';
                break;
            default:
                include '../../views/compenents/profile.php';
                break;
        }
    } catch (Exception $ex) {
        echo 'error' . $ex;
    }
}

function select_homework_menu($menu)
{
    try {
        switch ($menu) {
            case 'homeworks':
                include '../../views/compenents/homeworks.php';
                break;
            case 'create_homework':
                include '../../views/compenents/create_homework.php';
                break;
            default:
                include '../../views/compenents/homeworks.php';
                break;
        }
    } catch (Exception $ex) {
        echo 'error' . $ex;
    }
}
