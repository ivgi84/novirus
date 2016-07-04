<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
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
<%

response.Write(request.Form("result"))
response.Write("<br />")

confirm=mid(request.Form("result"), 71,7)
response.Write("Authorization Number = "&confirm)
response.Write("<br />")

Parmx=request.Form("parmx")
response.Write("Parmx = "&Parmx)
response.Write("<br />")

Id=request.Form("id")
response.Write("Id = "&Id)
response.Write("<br />")

Token=request.Form("token")
response.Write("Token = "&token)
%>
</body>
</html>
