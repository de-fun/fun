<?php
	$conn=mysql_connect("localhost","root","123") or die("���ݿ���������Ӵ���".mysql_error());
    mysql_select_db("funphp",$conn) or die("���ݿ���ʴ���".mysql_error());
    mysql_query("set character set utf-8");
	mysql_query("set names utf8");