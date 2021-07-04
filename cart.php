<?php
$PAGE_TITLE = 'Shopping Cart';
include('header.php');

    include "database.php";
    include_once("helpher.php");
    $conn = @mysqli_connect($hostname, $username, $password, $database) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    echo "<div class=\"section-shadow section-bgColor position-relative w-auto p-2 m-3 overflow-auto\" style='max-height: 600px;'>";
        echo "<form method=\"post\" action=\"checkout.php\">";
            /*Cart Table header*/
            echo "<table class=\"table table-light table-hover cartTBL  \">";
                echo "
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th style=\"width: 20%\">Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>";
                /*Show Product Added into cart*/
                $temp=array_keys($_COOKIE);			//Get key name of array
                $j=0;
                for($i=0;$i<count($temp);$i++)		//Loop all array key of cookie that exist
                {
                   // If the array key include "cart"(use to mark as product that want to add to cart)'
                    if (preg_match("/cart/", $temp[$i]))
                    {
                        $cartID = preg_replace("/cart/", "", $temp[$i]); // get out "cart" from array key

                        /*Get all information needed from database with associate id*/
                        $sql = "select * from products where product_id ='$cartID'";
                        $result = mysqli_query($conn, $sql);
                        $rows = mysqli_fetch_array($result);

                        $prod = getProdDetail($rows['product_id']);
                        $promo_price = $prod['promo_price'];
                        $prod_id = $prod['id'];
                        $prod_image = explode(",", $prod['image']);
                        $qty = $_COOKIE["cart$prod_id"];


                        echo "
                            <tr>
                            <td><input type='checkbox' class='ckBox' name=\"prodID[]\" value=".$prod['id']."></td>
                                <td><img src=\"Admin/Product%20Image/$prod_image[0]\" width=\"150px\" height=\"150px\"><p>".$prod['name']."</p></td>
                                <td><div style=\"width: 400px; height: 200px;overflow-x: hidden; overflow-y: scroll\">".$prod['desc']."</div></td>
                                <td><input type=\"text\" id='prodPrice' value=".$promo_price." readonly></td>
                                <td><input type=\"number\" id='quantity' name='quantity[". $j ."]' onchange=updateSubTotal(); value=".$qty." min='1' max=".$rows['product_published']." readonly></td>
                                <td><input type=\"text\" value=".calcSubTotal("$promo_price",$qty) ." id='subtotal' readonly></td>
                                <td><button type='button' class=\"btn btn-success modifyCart\" ><i class=\"fa fa-refresh\"></i></button>&nbsp;
								
                                    <button type='button' class=\"btn btn-danger\" onclick=Deletecookie(\"cart$prod_id\")><i class=\"fa fa-trash\"></i></button>
                                </td> 
                            </tr>";
                        $j++;
                    }
                }
            echo "</table>";

            echo "
                    <div class='position-sticky bg-light p-4 container-fluid' style='bottom: 0'>
                        <input type='button' class=\"btn btn-warning\" onclick=\"location='index.php'\" value='Continue Shopping'>
                        <input type='submit' class=\"btn btn-success float-right\" name='cart_checkOut' value='Check Out'>
                    </div>
                ";
        echo "</form>";
    echo "</div>";


?>


<?php include('footer.php') ?>

