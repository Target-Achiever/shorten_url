<?php

if($_POST) {

	switch ($_POST['type']) {

		case 'google':

			$jsonData = json_encode(['longUrl'=>$_POST['full_url']]);
			$curlObj = curl_init();
			curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyCPjH9K5sS0lmHCYG3NXRiei-IPJFY6_TY');
			curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlObj, CURLOPT_HEADER, 0);
			curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
			curl_setopt($curlObj, CURLOPT_POST, 1);
			curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
			$response = curl_exec($curlObj);
			// Change the response json string to object
			$json = json_decode($response);
			curl_close($curlObj);
			echo "<br/><br/><h4 style='text-align:center;'> Your shorten url is <a href='".$json->id."' target='_blank'> ".$json->id." </a>";
			break;

		case 'tinyurl':

			$curlObj = curl_init();
			curl_setopt($curlObj, CURLOPT_URL, 'http://tinyurl.com/api-create.php?url='.$_POST['full_url']);
			curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlObj, CURLOPT_HEADER, 0);
			$response = curl_exec($curlObj);
			curl_close($curlObj);
			echo "<br/><br/><h4 style='text-align:center;'> Your shorten url is <a href='".$response."' target='_blank'> ".$response." </a>";
			break;

		case 'isgd':

			$curlObj = curl_init();
			curl_setopt($curlObj, CURLOPT_URL, 'https://is.gd/create.php?format=json&url='.$_POST['full_url']);
			curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlObj, CURLOPT_HEADER, 0);
			$response = curl_exec($curlObj);
			$json = json_decode($response);
			curl_close($curlObj);
			echo "<br/><br/><h4 style='text-align:center;'> Your shorten url is <a href='".$json->shorturl."' target='_blank'> ".$json->shorturl." </a>";
			break;

		case 'bitly':

			$curlObj = curl_init();
			curl_setopt($curlObj, CURLOPT_URL, 'https://api-ssl.bitly.com/v3/shorten?access_token=8e115a6fdbeaa7e3c0c61f2273a5c43308f4d463&domain=bitly.com&longUrl='.urlencode($_POST['full_url']));
			curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlObj, CURLOPT_HEADER, 0);
			$response = curl_exec($curlObj);
			$json = json_decode($response);
			curl_close($curlObj);
			echo "<br/><br/><h4 style='text-align:center;'> Your shorten url is <a href='".$json->data->url."' target='_blank'> ".$json->data->url." </a>";
			break;

		default:
			echo "Not Found";
			break;
	}

	die("<br/><br/> <a href=''> Go back </a>");
}

?>



<form method="post">
	
	<p> Would you like to create shorten url ? </p>

	<input type="text" name="full_url" placeholder="Please enter your url" required />
	<br/>
	<br/>
	<label>
		<input type="radio" name="type" value="google" checked />
		Google
	</label>
	<label>
		<input type="radio" name="type" value="tinyurl" />
		Tinyurl
	</label>
	<label>
		<input type="radio" name="type" value="isgd" />
		Is gd
	</label>
	<label>
		<input type="radio" name="type" value="bitly" />
		Bitly
	</label>
	<br/>
	<br/>
	<input type="submit" value="Submit">

</form>