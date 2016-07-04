<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrap">
<div id="afterpaymentform">
<div id='afterPaymentForm'>
<?php
header('Content-Type: text/html; charset=utf-8'); 
$userData=array($_POST["fName"],$_POST["lName"],$_POST["userID"],$_POST["packageName"],$_POST["email"],$_POST["tel"],$_POST["dateTime"],$_POST["authNum"],$_POST["token"],$_POST["result"]);

if($userData[3]=="Nod32 Antivirus5"){
$packageTbl="tblNod32Antivirus";    
}
else if($userData[3]=="Smart Security 5"){
    $packageTbl="tblSmartSecurity";
}
else if($userData[3]=="Family Plan"){
    $packageTbl="tblFamilyPlan";
}
else{
    echo $packageTbl." table was not found";
    die();
}

//getDBuser
//require_once('/home/novirusc/connect.php');
require_once('connect.php');
$pass= new MyPass();

try{
$conn = new PDO('mysql:host=localhost;dbname=novirusc_NOD32', $pass->getName(), $pass->getPass());
$conn->exec("SET NAMES 'utf8'");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  


//getting a ProductID and Password

$sqlSelectNODdata="SELECT prodID, prodPass, MIN(prodNum) AS curProd FROM ".$packageTbl."";
$sqlDeleteNODdata="DELETE FROM ".$packageTbl." WHERE prodID=? and prodPass=?";
// Read prodID and prodPass from One of products table
$stmt=$conn->prepare($sqlSelectNODdata);
$stmt->execute();
$result=$stmt->fetchAll();
    if(count($result)){
        foreach($result as $row)
        $prodID=$row["prodID"];
        $prodPass=$row["prodPass"];
        $curProd=$row["curProd"];
        
    }
    else{
        print_r("No rows was found") ;
    }

//echo "<br />".$prodID." ".$prodPass." ".$curProd."<br />";

//Delete readed data from products table

$stmt->bindParam(':prodID',$prodID);
$stmt->bindParam(':prodPass',$prodPass);

$stmt=$conn->prepare($sqlDeleteNODdata);
$stmt->execute(array($prodID, $prodPass));

//Check user input
for($i=0; $i<$num; $i++){
    $userData[$i]=trim($userData[$i]);
    $userData[$i]=strip_tags($userData[$i]);
    $userData[$i]=htmlspecialchars($userData[$i]);
    $userData[$i]=mysql_real_escape_string($userData[$i]);
}

#Preparing the Query ONCE
$stmt=$conn->prepare('INSERT INTO tblUser (fName, lName, userID, product, email, phone, date)'.
                                     'VALUES(:fName, :lName, :userID, :product, :email, :phone, :date)');
$stmt->bindParam(':fName',$userData[0]);
$stmt->bindParam(':lName',($userData[1]));
$stmt->bindParam(':userID',$userData[2]);
$stmt->bindParam(':product',$userData[3]);
$stmt->bindParam(':email',$userData[4]);
$stmt->bindParam(':phone',$userData[5]);
$stmt->bindParam(':date',$userData[6]);
$stmt->execute();

$sqlInsertProd_UserData="INSERT INTO tblNod32Data (prodID, prodPass, userID, authNum, token, result) VALUES(:prodID, :prodPass, :userID, :authNum, :token, :result)";
$stmt=$conn->prepare($sqlInsertProd_UserData);
$stmt->bindParam(':prodID', $prodID);
$stmt->bindParam(':prodPass', $prodPass);
$stmt->bindParam(':userID', $userData[2]);
$stmt->bindParam(':authNum', $userData[7]);
$stmt->bindParam(':token', $userData[8]);
$stmt->bindParam(':result', $userData[9]);
$stmt->execute();

 
}catch(PDOException $e){
    echo ' Error is: '. $e->getMessage();
    die();
}

$sendTo="ivgi84@gmail.com";

//SENDING MAIL to User

$message ="<html><head></head><body><p>Full Name:".$userData[0]." ".$userData[1]."</p>";
$message .="<p>Ordered Package: ".$userData[3]."</p>";
$message .="<p>Product UserName: ".$prodID."</p>";
$message .="<p>Product Password: ".$prodPass."</p></body></html>";

$headers = "From: No-Virus" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
$headers .= "Sensitivity: Personal"."\r\n";
$sent=mail($userData[4],"No-Virus",$message, $headers);
if($sent){
    echo "<h4 id='afterPaymentData'>We sent you an email with all details.<br /><br />Thank you <br/><br />Product ID is: '.$prodID.'<br /> Product Password is: '.$prodPass.'<br /></div></h4>";
}
else{
    echo "Error sending message to user! Message was not sent";
    die;
}

//Mail to No-virus
$message ="<html><head></head><body><p>Full Name:".$userData[0]." ".$userData[1]."</p>";
$message .="<p>User ID: ".$userData[2]."</p>";
$message .="<p>Ordered Package: ".$userData[3]."</p>";
$message .="<p>Email: ".$userData[4]."</p>";
$message .="<p>Telephone: ".$userData[5]."</p>";
$message .="<p>Product UserName: ".$prodID."</p>";
$message .="<p>Product Password: ".$prodPass."</p>";
$message .="<p>Date:".$userData[6]."</p></body></html>";

$headers = "From: No-Virus" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
$headers .= "Sensitivity: Personal"."\r\n";
$sent=mail($sendTo,"No-Virus",$message, $headers);
if($sent){
    
}
else{
    echo "Error sending message to No-Virus! Message was not sent";
    die;
}
?>

</div>
</div>
</body>
</html>