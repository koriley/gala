<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function __autoload($class_name) {
    include '../model/model_' . $class_name . '.php';
}

$password = "Str@nG31";
$user = new user();

$myHash = $user->passwordToHash($password);
echo $myHash."<br/>";

$hashCheck = $user->checkPassword($myHash, $password);
echo $hashCheck;