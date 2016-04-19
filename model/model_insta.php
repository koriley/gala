<?php

/*
 * This is the class to handle instagram items.
 * 
 */

class insta {
    /*
     * We need to pass to the class instanciation, the OAuth information for instagram.
     */

    var $accessToken;
    var $clientID;
    var $clientSecret;
    public $endPoint;

    /*
     * constructor method, assign the vars
     * @param $at -> the access token
     * @param $clientID -> the  oAuth Client id for instagram
     * @param $clientSecret -> the OAuth client secret for instagram
     * @param $endPoint -> null -> the instagram api url, this will default to v1, but you can send a new endpoint if it changes before this
     * class isupdated.
     */

    function __construct($at, $clientID, $clientSecret, $endPoint = 'NULL') {
        $this->accessToken = $at;
        $this->clientID = $clientID;
        $this->clientSecret = $clientSecret;
        $this->endPoint = $endPoint;
        if ($this->endPoint == 'NULL') {
            $this->endPoint = "https://api.instagram.com/v1";
        }
    }

    /*
     * method to get json from instagram for 'hash' tag you send to the method.
     * picks apart instagram json, pulls needed arrays
     * adds them to the database for moderation.
     * 
     * @param $hash -> the hash tag to get from instagram
     */

    function hashTag($hash, $count) {
        //clean any html from the hash
        $hash = strip_tags($hash);
        $hash = str_replace('#', '', $hash);
        /*
         * Set up hastag endpoint
         * from: https://www.instagram.com/developer/endpoints/tags/
         * this method only gets the most recent 'cards' based on a hashtag
         */
        $newEndPoint = $this->endPoint;

        $newEndPoint .= '/tags/' . $hash . '/media/recent/';
        if ($this->accessToken != '') {
            $newEndPoint = $newEndPoint . "?access_token=" . $this->accessToken . "." . $this->clientID . "&scope=public_content&count=" . $count;
        } else {
            $newEndPoint = $newEndPoint . "?client_id=" . $this->clientID . "&scope=public_content&count=" . $count;
        }

        $json = file_get_contents($newEndPoint);
        $obj = json_decode($json, true);
        $objCount = count($obj['data']) ;
        //the nextline is the full json from instagram, if you are looking for something now listed.
        //print_r($obj['data']);
        
        for ($i = 0; $i <= $objCount; $i++) {
            $uniqueId = $obj['data'][$i]['id'];
            $cardImage = $obj['data'][$i]['images']['standard_resolution']['url'];
            $userName = $obj['data'][$i]['user']['username'];
            $caption = $obj['data'][$i]['caption']['text'];
            $userImage = $obj['data'][$i]['user']['profile_picture'];
            $tagCount = count($obj['data'][$i]['tags']) ;
            for ($a = 0; $a <= $tagCount; $a++) {
                if ($a == 0) {
                    $thisTag = $obj['data'][$i]['tags'][$a] . "|";
                }
                if ($a == $tagCount) {
                    $thisTag .= $obj['data'][$i]['tags'][$a];
                } else {
                    $thisTag .= $obj['data'][$i]['tags'][$a] . "|";
                }
            }
echo "<br/><-------------------------fake view to delete number $i--------------------------------->";
echo "<div style='width:600px'>";
            echo "<div>" . $uniqueId . "</div>";
            echo "<div>" . $userName . " <img src='" . $userImage . "' /></div>";
            echo "<img src='" . $cardImage . "' />";
            
            echo "<div>" . $caption . "</div>";
            //echo "<div>" . $thisTag . "</div></div>";
            echo "<-------------------------end fake view to delete number $i---------------------------------><br/>";
        }
        /* right now I am outputting the direct image, I need to pick out the vars I want to fill the 
         * database with.
         */
    }

}
