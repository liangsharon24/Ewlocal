<?php
$con=mysqli_connect("localhost","Ew","0000","Ew");
?>

<?php

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
    <img alt="appetizer1" src="img/appetizer/egg.jpg">
    <img alt="appetizer2" src="img/appetizer/salad.jpg">

    <ul>
        <li><?php echo $row['name'] ?></li>
        <li><?php echo $row['description'] ?></li>
        <li>$<?php echo $row['price'] ?></li>
        <li><a href="appetizer2.php?page=products&action=add&id=<?php echo $row['id_product'] ?>">Add to cart</a></li>
    </ul>

<?php

}

?>
    </table>
