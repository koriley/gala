<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require("model_twit.php");

/**
 * Description of model_twitDB
 *
 * @author koriley
 */
class twitDB extends twit {

    function getTweet($dbCon, $url, $rm, $count, $hash) {
        $getfield = '?count='.$count.'&q='.$hash;
        $string = json_decode(parent::setGetfield($getfield)
                ->buildOauth($url, $rm)
                ->performRequest(), $assoc = TRUE);
        
        foreach ($string['statuses'] as $items) {
           
            $uniqueId = "twitter_".$items['id']; //should be a unique id for the post
            $cardImage = $items['entities']['media'][0]['media_url']; //the image shared
            $userName = $items['user']['screen_name']; //the user name of the sharer
            $caption = str_replace("'", "\'", $items['text']); //the caption including hashTags for the post
            $userImage = preg_replace("/_normal/", "", $items['user']['profile_image_url']); //the user Image
            if($cardImage != ''){
                $sql = "INSERT INTO card(appID, caption, userName, userImage, sharedImage) VALUES ('$uniqueId','$caption','$userName','$userImage','$cardImage')";
            
            }else{
                $sql = "INSERT INTO card(appID, caption, userName, userImage) VALUES ('$uniqueId','$caption','$userName','$userImage')";
            
            }
            
$res = $dbCon->insert($sql);
            
        }
    }

}
