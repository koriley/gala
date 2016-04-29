<?php

/**
 * Sanatize varaibles before we send them to the database.
 *
 * @author koriley
 */
class sanatize {

    function removeHash($hashTag) {
        $hash = str_replace('#', '', $hashTag);
        return $hash;
    }

    function removeTags($string) {
        $newString = strip_tags($string);
        return $newString;
    }

    function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $isEmail = "false";
        } else {
            $isEmail = "true";
        }
        return $isEmail;
    }

}
