<?php
include("db_func.php");
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"   type="text/css" href="css/style.css"/>
	<title>Пошук за параметрами</title>
</head>

<body>

<div id="block-body">
<p align="right" id="block-basket"><img src="/images/cart-icon.png" /><a href="" ><?php 
if(isset($_GET['action']) && $_GET['action']=="add"){    
    $id=$_GET['id'];
    $result = mysql_query("SELECT * FROM cart WHERE cart_id_product = '$id'",$connection);
if (mysql_num_rows($result) > 0){
$row = mysql_fetch_array($result);    
$new_count = $row["cart_count"] + 1;
$update = mysql_query ("UPDATE cart SET cart_count='$new_count' WHERE cart_id_product ='$id'",$connection);   
}
else{
    $result = mysql_query("SELECT * FROM book WHERE id = '$id'",$connection);
    $row = mysql_fetch_array($result);
    mysql_query("INSERT INTO cart(cart_id_product,cart_price) VALUES(	
                            '".$row['id']."',
                            '".$row['price']."'					                                                  
						    )",$connection);	
}

          
    }
$result1 = mysql_query("SELECT * FROM cart, book WHERE book.id = cart.cart_id_product",$connection);
If (mysql_num_rows($result1) > 0)
{
$row1 = mysql_fetch_array($result1);

do
{
$count = $count + $row1["cart_count"];    
$int = $int + ($row1["price"] * $row1["cart_count"]); 

}
 while ($row1 = mysql_fetch_array($result1));

If ($count == 1 or $count == 21 or $count == 31 or $count == 41 or $count == 51 or $count == 61 or $count == 71 or $count == 81) ( $str = ' книга');
If ($count == 2 or $count == 3 or $count == 4 or $count == 22 or $count == 23 or $count == 24 or $count == 32 or $count == 33 or $count == 34 or $count == 42 or $count == 43 or $count == 44 or $count == 52 or $count == 53 or $count == 54 or $count == 62 or $count == 63 or $count == 64) ( $str = ' книги');
If ($count == 5 or $count == 6 or $count == 7 or $count == 8 or $count == 9 or $count == 10 or $count == 11 or $count == 12 or $count == 13 or $count == 14 or $count == 15 or $count == 16 or $count == 17 or $count == 18 or $count == 19 or $count == 20 or $count == 25 or $count == 26 or $count == 27 or $count == 28 or $count == 29 or $count == 30 or $count == 35 or $count == 36 or $count == 37 or $count == 38 or $count == 39 or $count == 40 or $count == 45 or $count == 46 or $count == 47 or $count == 48 or $count == 49 or $count == 50 or $count == 55 or $count == 56 or $count == 57 or $count == 58 or $count == 59 or $count == 60 or $count == 65) ( $str = ' книг');

if ($count > 81)
{
    $str=" кн";
}
 
     echo '<span>'.$count.$str.'</span> на суму <span>'.$int.'</span> грн';
}
else
{

     echo 'Кошик порожній';

}
?></a></p>
<div id="block-left">
<?php
	include("include/block-left.php");
?>
</div> 

<div id="block-content">
 <?php
 
if ($_POST["brand"])
  {
      $check_brand = implode("','",$_POST["brand"]);
  } 
if ($_POST["author"])
  {
      $check_author = implode("','",$_POST["author"]);
  } 
  
  $start_price = (int)$_POST["start_price"];
  $end_price = (int)$_POST["end_price"];


  if (!empty($check_brand) || !empty($end_price) || !empty($check_author))
  {
    
    if (!empty($check_brand)) $query_brand = " AND genre IN('$check_brand')";
    if (!empty($end_price)) $query_price = " AND price BETWEEN $start_price AND $end_price";
    if (!empty($check_author)) $query_author = " AND author IN('$check_author')";
    
    
  } 
$result = mysql_query("SELECT * FROM `book` WHERE id!='0' $query_brand $query_price $query_author",$connection);  

	if(mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
        echo '<ul id="block-tovar-grid">';
		do{
		  
          if($row["image"]!="" && file_exists("./images/".$row["image"])){
            $img_path='./images/'.$row["image"];
            $max_width = 200;
            $max_height = 200;
            list($width, $height) = getimagesize($img_path);
            $ratioh=$max_height/$height;
            $ratiow=$max_width/$width;
            $ratio = min($ratioh, $ratiow);
            $width=intval($ratio*$width);
            $height=intval($ratio*$height);
          } else{
            $img_path="/images/no-image.png";
            $width = 110;
            $height = 200;
          }
			echo '
			<li>
			<div class="block-images-grid">
                <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/> 
			</div>	
            <p class="style-title-grid">'.$row["title"].'</p>
            <a class="add-cart-style-grid" href="searchfilter.php?page=index&action=add&id='.$row['id'].'"></a>
            <p class="style-price-grid"><strong>'.$row["price"].'</strong> грн</p>
            <div class="mini-features">
              <p class="au">  Автор: '.$row["author"].'</p>
               Жанр: '.$row["genre"].'
              <br>Рік видачі: '.$row["year"].'
              <br>Кількість сторінок: '.$row["pages"].'
            </div>
			</li>
			';
		}
		while($row=mysql_fetch_array($result));
	}
 ?>
 </ul>
</div>
</div>

</body>
</html>