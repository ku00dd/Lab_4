<?php
	   $host='localhost';
       $user='root';
       $password='';
       $db='book';
       
       $connection=mysql_connect($host, $user, $password, $db);
       mysql_select_db($db, $connection) or die("���� �'������� � ��".mysql_error());
       mysql_query("SET names utf-8");

    
?>