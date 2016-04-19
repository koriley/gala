<?php
/*
* This control is built to test the hashTag method.
* hashTag(The Tag, Number to pull)
*/
function __autoload($class_name) {
    include '../model/model_' . $class_name . '.php';
}
$token = '';
$clientID = '7183968862b543b28120a8e332a59fb5';
$clientSecret = '';
$hash = 'cat';

$myInsta = new insta($token, $clientID, $clientSecret);
$res = $myInsta->hashTag($hash, 20);
echo $res;
