<?php
include __DIR__ . '/../repositories/user_repository.php';

function show_user_photo($userId){
    $photoSrc = get_user_photo($userId);
    return   $photoSrc;
}