<div id="block-category">
<p class="header-title">Підбір за параметрами</p>
<p class="title-filter">Вартість</p>

<form method="POST" action="searchfilter.php">
<div id="block-imput-price">
<ul>
<li><p>від</p></li>
<li><input type="text" id="start-price" name="start_price" value="50"/></li>
<li><p>до</p></li>
<li><input type="text" id="end-price" name="end_price" value="700"/></li>
</ul>
</div>
<div id="blocktrackbar">
<p class="title-filter">Жанр</p>
<ul class="chekbox-brand">

<?php
$result=mysql_query("select distinct `genre` from `book` order by `genre` ", $connection);
if(mysql_num_rows($result)>0){
    $row=mysql_fetch_array($result);
    $count=0;
		do{
		  $count++;
		  echo '
          <li><input type="checkbox" name="brand[]" value="'.$row["genre"].'" id="chekbrand'.$count.'"/><label for="chekbrand'.$count.'">'.$row["genre"].'</label></li>
          ';
		  }
          while($row=mysql_fetch_array($result));
}

?>


</ul>
<p class="title-filter">Автор</p>
<ul class="chekbox-author">

<?php
$result=mysql_query("select distinct `author` from `book` order by `author` ", $connection);
if(mysql_num_rows($result)>0){
    $row=mysql_fetch_array($result);
    $count=0;
		do{
		  $count++;
		  echo '
          <li><input type="checkbox" name="author[]" value="'.$row["author"].'" id="chekauthor'.$count.'"/><label for="chekauthor'.$count.'">'.$row["author"].'</label></li>
          ';
		  }
          while($row=mysql_fetch_array($result));
}

?>


</ul>

<input type="submit" name="submit" id="button-param-search" value="Знайти"/>

</div>
</form>

</div>