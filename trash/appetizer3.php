<?php
session_start();

$con=mysqli_connect("localhost","Ew","0000","Ew");

    if(isset($_GET['action']) && $_GET['action']=="add"){

        $id=intval($_GET['id']);

        if(isset($_SESSION['cart'][$id])){

            $_SESSION['cart'][$id]['quantity']++;

        }else{

            $sql_s="SELECT * FROM products
                WHERE id_product={$id}";
            $query_s=mysqli_query($con,$sql_s);
            if(mysqli_num_rows($query_s)!=0){
                $row_s=mysqli_fetch_array($query_s,MYSQLI_ASSOC);

                $_SESSION['cart'][$row_s['id_product']]=array(
                        "quantity" => 1,
                        "price" => $row_s['price']
                    );

            }else{
                $message="This product id it's invalid!";
            }
        }
    }

?>

<?php
require("includes/connection.php");
if(isset($_GET['page'])){

    $pages=array("products", "cart");

    if(in_array($_GET['page'], $pages)) {

        $_page=$_GET['page'];

    }
    else{
        $_page="products";
    }
}
else{
    $_page="products";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/mystyle.css">
<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,200,500,600,700,100' rel='stylesheet' type='text/css'>
<title>Appetizer</title>


</head>

<body>
  <div class="menu">
    <a href="main.html">Home</a>
    <a href="appetizer.html" class="current">Appetizer</a>
    <a href="soup.html">Soup</a>
    <a href="maindish.html">Main Dishes</a>
    <a href="dessert.html">Desserts</a>
  </div>

<div id="container">

    <div id="main">

      <?php
      $con=mysqli_connect("localhost","Ew","0000","Ew");
      ?>


      <h1>Product List</h1>
      <?php
      if(isset($message)){
          echo "<h2>$message</h2>";
      }
      ?>

      <?php

      $sql="SELECT * FROM products where id_product IN (1,2) ORDER BY name ASC";
      $query=mysqli_query($con,$sql);

      while ($row=mysqli_fetch_array($query,MYSQLI_ASSOC)) {

      ?>
          <ul>
              <li><img alt="appetizer" src="<?php echo $row['photo'] ?>"></li>
              <li><?php echo $row['name'] ?></li>
              <li><?php echo $row['description'] ?></li>
              <li>$<?php echo $row['price'] ?></li>
              <li><a href="appetizer.php?action=add&id=<?php echo $row['id_product'] ?>">Add to cart</a></li>
          </ul>
      <?php

      }

      ?>


    </div><!--end of main-->

    <div id="sidebar">

      <h1>Cart</h1>
      <?php

          if(isset($_SESSION['cart'])){

              $sql="SELECT * FROM products WHERE id_product IN (";

              foreach($_SESSION['cart'] as $id => $value) {
                  $sql.=$id.",";
              }

              $sql=substr($sql, 0, -1).") ORDER BY name ASC";
              $query=mysqli_query($con,$sql);
              while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){

              ?>
                  <p><?php echo $row['name'] ?> x <?php echo $_SESSION['cart'][$row['id_product']]['quantity'] ?></p>
              <?php

              }
          ?>
              <hr />
              <a href="index.php?page=cart">Go to cart</a>
          <?php

          }else{

              echo "<p>Your Cart is empty. Please add some products.</p>";

          }

      ?>
    </div><!--end of sidebar-->

</div><!--end container-->

</body>
</html>
