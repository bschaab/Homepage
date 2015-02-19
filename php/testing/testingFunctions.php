<?php 
	
	$passColor = "#3CD376";
	$failColor = "#CF1916";
	
	$documentRoot = "http://localhost:8888";
	
	function assertContains($title, $haystack, $needle) {
		
		global $passColor, $failColor;
		
		if (strpos($haystack, $needle) === false) {
			die("<span style='background-color:$failColor'>$title Assertion Failed!</span><br/><br/>");
		}
		else {
			echo("<span style='background-color:$passColor'>$title Assertion Passed!</span><br/><br/>");
		}
	}
	
	
	function assertNotContains($title, $haystack, $needle) {
		
		global $passColor, $failColor;
		
		if (strpos($haystack, $needle) !== false) {
			die("<span style='background-color:$failColor'>$title Assertion Failed!</span><br/><br/>");
		}
		else {
			echo("<span style='background-color:$passColor'>$title Assertion Passed!</span><br/><br/>");
		}
	}

	
	function openURL($url) {
		
		//open connection
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_URL, $url);
		
		//execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);
		
		return $result;
	}
	
	
	function postURL($url, $fields) {
		
		//open connection
		$ch = curl_init();
		
		//url-ify the array data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_URL, $url);
		
		//execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);
		
		return $result;
	}
	
?>