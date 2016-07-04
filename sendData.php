
<?
$username="titicoil_ivgi";
$password="issue2001";
$database="titicoil_test";

$name="Evgeny";
$tel="2342342";
$email="ivgi84@gmail.com";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query = "INSERT INTO test VALUES ('$name','$tel','$email')";
mysql_query($query);

mysql_close();
?>