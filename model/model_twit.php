<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class for twitter api
 *
 * @author koriley
 */
class twit {
    
   
    private $oauth_access_token;
    private $oauth_access_token_secret;
    private $consumer_key;
    private $consumer_secret;
    
    /*
     * Constructor method to establish oAuth connection
     * 
     * @param $at -> twitter app access token
     * @param $ats -> twitter access token secret
     * @param $ck -> twitter consumer key
     * @param $cs ->  twitterconsumer secret
     * @param $ep -> the twitter default api url endPoint
     */
    
    function __construct($at, $ats, $ck, $cs, $ep){
        
    }
    
    /*
     * method to retrieve tweets from API, and put them into Database
     * 
     * @param $dbCon -> the pdo instanciation
     * @pram $hash -> the hash tag to search for
     */
    function getTweet($dbCon, $hash){
        
    }
}
