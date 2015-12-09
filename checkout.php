  <div id="checkout">

      <h1>Check Out</h1>
      <?php

          if(isset($_SESSION['cart'])){

              $sql="SELECT * FROM products WHERE id_product IN (";

              foreach($_SESSION['cart'] as $id => $value) {
                  $sql.=$id.",";
              }

              $sql=substr($sql, 0, -1).") ORDER BY name ASC";
              $query=mysqli_query($con,$sql);
              $totalprice=0;
              while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
                $subtotal=$_SESSION['cart'][$row['id_product']]['quantity']*$row['price'];
                $totalprice+=$subtotal;
              ?>
                  <p><?php echo $row['name'] ?> x <?php echo $_SESSION['cart'][$row['id_product']]['quantity'] ?> x <?php echo $row['price'] ?></p>
              <?php

              }
          ?>
          <tr>
              <td colspan="4">Total Price: <?php echo $totalprice ?></td>
          </tr>
              <hr />
              <a href="index.php?page=cart">Go to cart</a>
          <?php

          }else{

              echo "<p>Your Cart is empty. Please add some products.</p>";

          }

      ?>
    </div><!--end of sidebar-->
