<?php	

//twitter age
function timeSince($original) // $original should be the original date and time in Unix format
{
    if (defined("ICL_LANGUAGE_CODE") && ICL_LANGUAGE_CODE=="fr"){
        $timePrefix = "Il y a ";
        $timeSuffix = "";
        // Common time periods as an array of arrays
        $periods = array(
            array(60 * 60 * 24 * 365 , 'ans'),
            array(60 * 60 * 24 * 30 , 'mois'),
            array(60 * 60 * 24 * 7, 'semaine'),
            array(60 * 60 * 24 , 'jour'),
            array(60 * 60 , 'heure'),
            array(60 , 'minute'),
        );
    }else{
        $timePrefix = "";
        $timeSuffix = " ago";
        // Common time periods as an array of arrays
        $periods = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
        );
    }
   
    $today = time();
    $since = $today - $original; // Find the difference of time between now and the past
   
    // Loop around the periods, starting with the biggest
    for ($i = 0, $j = count($periods); $i < $j; $i++)
        {    
        $seconds = $periods[$i][0];
        $name = $periods[$i][1];
       
        // Find the biggest whole period
        if (($count = floor($since / $seconds)) != 0){
            break;
        }
    }
    
    if ($count == 1){
        $output = $timePrefix . '1 '. $name;
    }else{
        if ($name == "mois" || $name == "ans"){
            //don't add an S for these two french times
            $output = $timePrefix . $count . " " . $name;
        }else{
            $output = $timePrefix . $count . " " . $name . "s";
        }
    }
   
    if ($i + 1 < $j)
        {
        // Retrieving the second relevant period
        $seconds2 = $periods[$i + 1][0];
        $name2 = $periods[$i + 1][1];
       
        // Only show it if it's greater than 0
        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0){
            if ($name2 == "mois" || $name2 == "ans"){
                $output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}";
            }else{
                $output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
            }

            $output .= $timeSuffix;

        }
    }
    return $output;
}


//tweet parsers



function addUrls($text){

	// The Regular Expression filter
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
  
	// Check if there is a url in the text

	// force http: on www.
		$text = preg_replace( "@www\.@", "http://www.", $text );
	// eliminate duplicates after force
		$text = preg_replace( "@http://http://www\.@", "http://www.", $text );
		$text = preg_replace( "@https://http://www\.@", "https://www.", $text );

	if(preg_match($reg_exUrl, $text, $url)) {
		   // make the urls hyper links
		   $text = preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
	}  

    $text= preg_replace("/@(\w+)/", '<a href="http://www.twitter.com/$1" target="_blank">@$1</a>', $text);   
    $text= preg_replace("/\#(\w+)/", '<a href="http://twitter.com/search?q=$1" target="_blank">#$1</a>',$text);   

	return ($text);
}
?> 