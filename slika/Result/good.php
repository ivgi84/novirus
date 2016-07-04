<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial;
}
-->
</style></head>
<body>


<?

echo "Result = ".$_POST['result'];
echo '<br>';

echo "Authorization Number = ".substr($_POST['result'], 70, 7);
echo '<br>';

echo "ParmX = ".$_POST['parmx'];
echo '<br>';

echo "Id = ".$_POST['id'];
echo '<br>';

echo "Token = ".$_POST['token'];
echo '<br>';

?>
</body>
</html>
