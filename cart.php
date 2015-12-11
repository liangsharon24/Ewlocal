<?php
if(isset($_POST['submit'])){

foreach($_POST['quantity'] as $key => $val) {
    if($val==0) {
        unset($_SESSION['cart'][$key]);
    }else{
        $_SESSION['cart'][$key]['quantity']=$val;
    }
}

}
?>
<h1>View cart</h1>
<a href="main.html">Go back to products page</a>
<form method="post" action="index.php?page=cart">

    <table>

        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Items Price</th>
        </tr>

        <?php
        $con=mysqli_connect("mysql4.000webhost.com","a9672506_Ew","abcd1234","a9672506_Ew");

            $sql="SELECT * FROM products WHERE id_product IN (";

                    foreach($_SESSION['cart'] as $id => $value) {
                        $sql.=$id.",";
                    }

                    $sql=substr($sql, 0, -1).") ORDER BY name ASC";
                    $query=mysqli_query($con,$sql);
                    $totalprice=0;
                    if($query === false){
                       echo "<h2>There are no items in your cart. Try shopping something!</h2>";
                       die(mysql_error());
                    }
                    while($row=mysqli_fetch_array($query)){
                        $subtotal=$_SESSION['cart'][$row['id_product']]['quantity']*$row['price'];
                        $totalprice+=$subtotal;
                    ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><input type="text" name="quantity[<?php echo $row['id_product'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['id_product']]['quantity'] ?>" /></td>
                            <td>$<?php echo $row['price'] ?></td>
                            <td>$<?php echo $_SESSION['cart'][$row['id_product']]['quantity']*$row['price'] ?></td>
                        </tr>
                    <?php

                    }
        ?>
                    <tr>
                        <td colspan="4">Total Price: <?php echo $totalprice ?></td>
                    </tr>

    </table>
    <br />
    <button type="submit" name="submit">Update Cart</button>
</form>
<br />
<p>To remove an item, set it's quantity to 0. </p>
