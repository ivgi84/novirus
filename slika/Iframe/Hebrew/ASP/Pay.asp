<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
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
<%

    userName="PeleTest"
    password = "Pelecard@Test"
    termNo="0962210"

    password=replace(password, "+", "`9`")
    password=replace(password, "&", "`8`")
    password=replace(password, "%", "`7`")

    goodUrl=Server.UrlEncode(request("goodUrl"))
    errorUrl=Server.UrlEncode(request("errorUrl"))
    total=request("total")
    currncy=request("currency")
    maxPayments=request("maxPayments")     
    minPaymentsNo=request("minPaymentsNo")
    creditTypeFrom=request("creditTypeFrom")
    styleSheetAddress=Server.UrlEncode(request("styleSheetAddress"))
    headText=Server.UrlEncode(request("headText"))
    bottomText=Server.UrlEncode(request("bottomText"))
	hidePelecardLogo=request("hidePelecardLogo")
	Background=request("Background")
	backgroundImage=request("backgroundImage")
	topMargin=request("topMargin")
    supportedCardTypes=request("supportedCardTypes")
	Parmx=Server.UrlEncode(request("Parmx"))
    hideParmx=request("hideParmx")
	cancelUrl=Server.UrlEncode(request("cancelUrl"))
	supportPhone=request("supportPhone")
	errorText=request("errorText")
    id=request("id")
    cvv2=request("cvv2")
    authNum=request("authNum")
    shopNo=request("shopNo")
    frmAction=request("frmAction")
	TokenForTerminal=request("TokenForTerminal")
    J5=request("J5")
    keepSSL=request("keepSSL")


sURL = "https://gateway.pelecard.biz/Iframe?Parmx="&Parmx&"&userName="&userName&""
	sRqurl ="userName="&userName&_
	"&password="&password&_
	"&termNo="&termNo&_
    "&pageName=ajaxPage"&_
    "&goodUrl="&goodUrl&_
    "&errorUrl="&errorUrl&_
    "&total="&total&_
	"&currency="&currncy&_
    "&maxPayments="&maxPayments&_
    "&minPaymentsNo="&minPaymentsNo&_
    "&creditTypeFrom="&creditTypeFrom&_
    "&styleSheetAddress="&styleSheetAddress&_
    "&headText="& headText&_
    "&bottomText="&bottomText&_
    "&hidePelecardLogo="&hidePelecardLogo&_
    "&Background="&Background&_
    "&backgroundImage="&backgroundImage&_
    "&topMargin="&topMargin&_
    "&supportedCardTypes="&supportedCardTypes&_
	"&hideParmx="&hideParmx&_
    "&cancelUrl="&cancelUrl&_
    "&supportPhone="&supportPhone&_
    "&errorText="&errorText&_
	"&id="&id&_
    "&cvv2="&cvv2&_
	"&authNum="&authNum&_
	"&shopNo="&shopNo&_
    "&frmAction="&frmAction&_
    "&TokenForTerminal="&TokenForTerminal&_
    "&J5="&J5&_
    "&keepSSL="&keepSSL&_
    "&Parmx="&Parmx&""
	
    SendString = sRqurl

	Set xml = Server.CreateObject("msxml2.serverXMLHTTP")
	set xmlDom = Server.CreateObject("Microsoft.XMLDOM")
	xml.Open "POST", sURL, False
	xml.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xml.Send (SendString)
    If xml.readyState <> 4 then
    xml.waitForResponse 10
    End If
    
    pageStatus=xml.status

    if pageStatus = 200 then
    Response.Write(xml.responseText)
    end if

	xmlDom.async = false
	Set xml = Nothing

 %>

 
 <input type="hidden" name="noCheck" value="true" id="noCheck" />
</form>

<%

    response.Write("<script type='text/javascript'>")
    response.Write("function submitForm()")
    response.Write("{")
    response.Write("document.form4.submit();")
    response.Write("}")
    response.Write("submitForm();")
    response.Write("</script>")
 %>
 </div>
</body>
</html>
