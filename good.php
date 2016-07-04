<?php 

session_start();

//The second parameter on print_r returns the result to a variable rather than displaying it
$RequestSignature = md5($_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].print_r($_POST, true));

if ($_SESSION['LastRequest'] == $RequestSignature)
{
	$CustomerID=NULL;
	$packageDetail=NULL;
  echo 'This is a refresh.';
}
else
{
	$CustomerID=$_POST['id'];
	$packageDetail=$_POST['parmx'];
  echo 'This is a new request.';
  $_SESSION['LastRequest'] = $RequestSignature;
}




// $CustomerID="142385736";
// $packageDetail="Smart Security 5";
date_default_timezone_set("Asia/Tel_Aviv");
if(!$CustomerID||!$packageDetail){ 
	$user="no";
}
else{
	$user="yes";
}
?>

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="he"><![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="he">
<link rel="stylesheet" type="text/css" href="css/ie7.css" /> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en">
    <link rel="stylesheet" type="text/css" href="css/ie8.css" /> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="he">
<!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>No Virus</title>
    <meta name="description" content="No-virus" />
    <meta name="viewport" content="width=device-width" />
    <meta name="keywords" content="No-Virus" />
    <meta name="author" content="Evgeny Smolovich" />
    <meta name="copyright" content="&copy; 2011 Evgeny Smolovich. All rights reserved." />
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
    <link rel="stylesheet" href="css/style.css" />
    <link href="css/layout.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link href="css/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" /><![endif]-->
    <!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" /><![endif]-->
    <!--[if IE]><link rel="stylesheet" type="text/css" href="css/IE.css" /><![endif]-->
    <script src="js/libs/modernizr-2.5.2.min.js"></script>
    <script src="js/script.js"></script>

</head>
<body>
    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
    <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
    <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="css/ie7.css" />
    <![endif]-->

    <div id="wrap">
        <!--<div id="nav_bg">
            <nav>
                <div id="logo">
                    <img src="images/logo.png" alt="Logo No-Virus" />
                </div>
                <ul>
                    <li class="nav_selected"><a href="index.html">דף בית</a></li>
                    <li>התקנה וטיפים</li>
                    <li><a href="compare.html">השוואת מוצרים</a></li>
                    <li><a href="#contactForm">צור קשר</a></li>
                </ul>
            </nav>-->
        </div>
        <div id="header_bg">
            <header>
            </header>
        </div>
        <div id="main_content" style="margin-top:-450px;">
            <div role="main">
                <div id="afterPaymentForm">

                 <p id="userData"></p>
                    <form method="post" id="APform" action="ajaxSend.php">
                    <input class="APformInput" type="text" name="fName" id="fName" value="" size="20" /><label class="APformLabel" for="fName"> שם פרטי </label><br />
                    <input class="APformInput" type="text" name="lName" id="lName" value="" size="20" /><label class="APformLabel" for="lName"> שם משפחה </label><br />
                    <input class="APformInput" type="text"  name="userID" id="userID" value="<?php echo $CustomerID ?>" /><label class="APformLabel" for="iserID"> ת.ז. </label><br />
                    <input class="APformInput" type="text"  name="packageName" id="packageName" value="<?php echo $packageDetail ?>" /><label class="APformLabel" for="packageName"> חבילה שבחרת </label><br />
                    <input class="APformInput" type="email" name="email" id="email" size="30" /><label class="APformLabel" for="email"> הזן כתובת אימייל </label><br />
                    <input class="APformInput" type="email" name="emailCheck" id="emailCheck" size="30" /><label class="APformLabel" for="emailCheck">הזן אימייל שינית לבדיקה</label><br />
                    <input class="APformInput" type="tel" name="phone" id="phone"  size="15" /><label class="APformLabel" for="phone"> מס' טלפון </label><br />
                    <input type="text" hidden="hidden" style="display: none;" name="orderTime" id="orderTime" value="<?php echo date("Y/m/d H:i:s")  ?>" />
                    <input type="text"  name="authNum" id="authNum" value="<?php echo $_POST["authNum"] ?>" /><br />
                    <input type="text" hidden="hidden" style="display: none;" name="token" id="token" value="<?php echo $_POST["token"] ?>" /><br />
                    <input type="text" hidden="hidden" style="display: none;" name="result" id="result" value="<?php echo $_POST["result"] ?>" /><br />                    
                    <?php 
							if($user=="no"){
								echo "חסרים פירטי משתמש";
							}
							if($user=="yes"){
								echo  "<input class='APformBtnSend' type='image' name='APform_btn_send' id='APform_btn_send' src='images/btn_send.jpg' />";
							}  
                    ?>

                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
      <!--  <div class="preFooter"></div>
        <footer>
            <div>
                <img src="images/footer_txt.png" alt="text" /></div>
        </footer>
        <div id="after_footer">
            <div>
                <a href="http://www.balancepro.co.il">
                    <img src="images/footer_logo.png" alt="balancePro" />שיווק באינטרנט ובניית אתרים</a>
                <a id="takanon" target="_blank" href="http://novirus.co.il/takanon/takanon.pdf">תקנון האתר</a>
            </div>
        </div>-->
    </div>


    <!-- JavaScript at the bottom for fast page loading -->
    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery.featureCarousel.js" type="text/javascript"></script>
    <script>        window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
    <!-- scripts concatenated and minified via build script -->
    <script src="js/plugins.js"></script>
    
    <!-- end scripts -->
</body>
</html>
