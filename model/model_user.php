<?php

/*
 * This class is the basic user creation and authenacation methods
 */

/**
 * @author koriley
 */
class user {
    /*
     *  create a user login. Check to make sure that the email has not been used.
     * hash the password.
     * add the user to database.
     * 
     * @param $dbCon -> the database connection
     * @param $email -> this will be the unique user name
     * @param $password -> the password to be hashed
     * @param $firstName -> user first name
     * @param $lastName -> user last name
     * @param $compName -> the company name
     */

    //function createLogin($dbcon, $email, $password, $firstName, $lastName, $compName) {
    function createLogin($password) {
        $hash = self::passwordToHash($password);
        $today = date("d.m.Y-H:i");
        
        //return $hash;
    }

    /*
     * Take the password the user has created for their account and create a hash for it.
     * 
     * (core) -> This is only used for user creation
     * 
     * @param $password -> the entered password
     * 
     * @return $hash -> the encrypted password
     */

    function passwordToHash($password) {
        $cost = rand(5, 10); //random cost
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.'); //random string
        /* Prefix information about the hash so PHP knows how to verify it later.
         * "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
         */
        $salt = sprintf("$2a$%02d$", $cost) . $salt;
        // Hash the password with the salt
        $hash = crypt($password, $salt);

        return $hash;
    }

    /*
     * This will pull the hash from the database and check if the user entered password matches the 
     * hash.
     * 
     * @param $password -> user entered password
     * @parm $hash -> the hash from the database
     * 
     * @return true or false
     */

    function checkPassword($hash,$password) {
        if (hash_equals($hash, crypt($password, $hash))) {
            return "true";
        } else{
            return "Passwords do not match";
        }
    }

}
