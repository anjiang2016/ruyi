<?php
	@header("HTTP/1.0 404 Not Found");
?>
<!DOCTYPE html PUBliC "-//W3C//DTD XHTML 1.0 Transitional//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>û���ҵ���Ҫ���ʵ�ҳ��</title>
 <style type="text/html">BODY {
	FONT-SIZE: 14px; FONT-FAMILY: arial,sans-serif
}

H1 {
	FONT-SIZE: 22px
}
UL {
	MARGIN: 1em
}
li {
	liNE-HEIGHT: 2em; FONT-FAMILY: ����
}
A {
	COLOR: #00f
}
</style>
</head>
 <body>
<blockquote>
  <h1>û���ҵ���Ҫ���ʵ�ҳ��</h1>
  The requested URL was not found on this server. 
  <ol>
    <li>�������ҳ�棬���������������ַ����ȷ��</li>
	<li>Ҳ������վ�������˷�������֧�ֵ�URL��̬��ģʽ��</li>
	<li><?php echo $msg;?></li>
	</ol>
  </blockquote> <p></p></body>
</html>
<?php exit;?>