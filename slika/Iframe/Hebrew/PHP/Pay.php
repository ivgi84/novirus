<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
 <div style="width:100%"><center><img src="images/loading.gif" width="400" height="400" alt=""/></center></div> 
 <div style="visibility:hidden" > 
 <form id="form4" name="form4" action="https://gateway.pelecard.biz/Iframe" method="post">
<?php
    
	$userName = "PeleTest";
	$password = "Pelecard@Test";
	$termNo = "0962210";

	$password = str_replace("+", "`9`", $password);
	$password = str_replace("&", "`8`", $password);
	$password = str_replace("%", "`7`", $password);    

 	$data = array(
			'userName' => $userName,        
			'password' => $password,
			'termNo' => $termNo,
			'pageName' => 'ajaxPage',
			'goodUrl' => $_POST['goodUrl'],
			'errorUrl' => $_POST['errorUrl'],
			'total' => $_POST['total'],
			'currency' => $_POST['currency'],
			'maxPayments' => $_POST['maxPayments'],
			'minPaymentsNo' => $_POST['minPaymentsNo'],
			'creditTypeFrom' => $_POST['creditTypeFrom'],
			'styleSheetAddress' => $_POST['styleSheetAddress'],
			'headText' => $_POST['headText'],
			'bottomText' => $_POST['bottomText'],
			'hidePelecardLogo' => $_POST['hidePciLogo'],
			'Background' => $_POST['Background'],
			'backgroundImage' => $_POST['backgroundImage'],
			'topMargin' => $_POST['topMargin'],
			'supportedCardTypes' => $_POST['supportedCardTypes'],
			'parmx' => $_POST['Parmx'],
			'hideParmx' => $_POST['hideParmx'],
			'cancelUrl' => $_POST['cancelUrl'],
			'supportPhone' => $_POST['supportPhone'],
			'errorText' => $_POST['errorText'],
			'id' => $_POST['id'],
			'cvv2' => $_POST['cvv2'],
			'authNum' => $_POST['authNum'],	
			'shopNo' => $_POST['shopNo'],
			'frmAction' => $_POST['frmAction'],
			'TokenForTerminal' => $_POST['TokenForTerminal'],
			'J5' => $_POST['J5'],
			'keepSSL' => $_POST['keepSSL'] ## NO TRAILING COMMA
			);
	
	
	list ($code, $result) = do_post_request($data);
	
	## Submit the data into pelecard servers
	function do_post_request($data, $optional_headers = null)	{
		$params = array('http' => array(
				'method' => 'POST',
				'content' => http_build_query($data)
				));

		$url = 'https://gateway.pelecard.biz/Iframe';

		if ($optional_headers !== null) {
			$params['http']['header'] = $optional_headers;
		}
		$ctx = stream_context_create($params);
		
		$fp = @fopen($url, 'rb', false, $ctx);
		fpassthru($fp);
		if (!$fp) {
			throw new Exception("Problem with $url, $php_errormsg");
		}
		$response = @stream_get_contents($fp);
		if ($response === false) {
			throw new Exception("Problem reading data from $url, $php_errormsg");
		}
		return array(substr(trim(strip_tags($response)),0,3), trim(strip_tags($response)));
	}

?>

 
<input type="hidden" name="noCheck" value="true" id="noCheck" />
</form>
<script type='text/javascript'>
function submitForm() { document.form4.submit();}
submitForm();
</script>
 
 </div>
</body>
</html>
