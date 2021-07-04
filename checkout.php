<?php
$PAGE_TITLE = "CheckOut";
include('header.php');
include("database.php");


include_once('helpher.php');
/*Set submit button - avoid submit without select for delivery method*/
if(isset($_POST['delivery'])){
    $delivery = $_POST['delivery'];
    echo "<script type='text/javascript'>
                window.onload = function(){
                 /*Set the selected delivery method as  checked*/
                 $('#delivery" . $delivery . "').prop('checked', true);
                 /*To enable the submit button*/
                 document.getElementById('ckSubmit').disabled = false;
                 }
            </script>";

    /*To get the delivery price for selected delivery method form database*/
    $dlvy = getDelivery($delivery);
    $dlvy_price = $dlvy['price'];

    /*If click submit button with selected the delivery method*/
    if(isset($_POST['order-submit'])){
        $_SESSION['delivery'] = $delivery;
        echo "<meta http-equiv=\"refresh\" content=\"0; url=payment.php\">";
    }

}else{
    /*To disable the submit button*/
    echo "<script type='text/javascript'>
                window.onload = function(){
                 document.getElementById('ckSubmit').disabled = true;
                 }
            </script>";

    /*Set default value for delivery price*/
    $dlvy_price =0.0;
}


/*Set the way where customer check out*/
/* 1. P = product page*/
/* 2. C = cart*/
if (isset($_POST['prod_checkOut'])) {
    $_SESSION['ckOUT'] = 'P';
} else if (isset($_POST['cart_checkOut'])) {
	if(isset($_POST['prodID'])){
		    $_SESSION['ckOUT'] = 'C';
	}else{
		    $_SESSION['ckOUT'] = 'NC';
	}

}

	if ($_SESSION['ckOUT'] == 'NC') { // If no select product to checkout from cart
			echo "<meta http-equiv=\"refresh\" content=\"2; url=cart.php\">";
			echo "<div class='error' style='font-size: 20px;'><strong>No Product Selected!</strong> Auto return to cart after 2 second.</div>";
	}
    /*If Check out from Cart or product page*/
    else if ($_SESSION['ckOUT'] == 'P' || $_SESSION['ckOUT'] == 'C') {
        echo "<div class=\"section-bgColor section-shadow\">";
        /*Order form*/
        echo "<form action='checkout.php' method='post'>";
        echo "<div class=\"container-fluid row order \">";
        echo "<div class=\"col-8 order-detail \">";
        echo "<div  style=' padding-left : 30px;'>";
        echo "<table cellpadding=\"10px\" style='width: 100%;'>";
        echo "<tr>
                     <th>ITEMS</th>
                     <th></th>
                     <th>PRICE</th>
                
                     <th class=\"text-right\">QUANTITY</th>
                  </tr>
                  <tr>
                          <td colspan=\"4\">
                              <hr style=\"border: 2px solid darkgrey\">
                          </td>
                  </tr>
                 ";

        /*Set default value*/
        $totalProd = $subTotal = $totalAmt = 0;
        $loop = 0;
        $prodID = array();
        $qty = array();

        /*If return to checkout page from payment*/
        if(isset($_POST['back']) || !isset($_POST['prodID']) || !isset($_POST['quantity'])){
            $prodID = $_SESSION['prodID'];
            $qty = $_SESSION['qty'];
        /*Access to checkout page from product page or cart*/
        }else{
            $prodID = $_POST['prodID'];
            $qty = $_POST['quantity'];

            /*Create the session for product id and qty to able to get back value if return this page from payment page*/
            $_SESSION['prodID'] = $_POST['prodID'];
            $_SESSION['qty'] = $_POST['quantity'];
        }
        /*Get out all product detail*/

        for ($i=0; $i<sizeof($prodID); $i++) {
            $product = getProdDetail($prodID[$i]);
            $image = explode(",", $product['image']);
            $prod_rate = round(($product['price'] - $product['promo_price']) / $product['price'] * 100);
            $totalProd++; //total type of product order by customer.
            $subTotal += ($product['promo_price'] * (int)$qty[$loop]); // calculate subtotal of product
            $totalAmt = $subTotal +  $dlvy_price; // final amount

            echo "<tr>
                                <td><img src=\"Admin/Product%20Image/$image[0]\" width=\"100\" height=\"100\"></td>
                                <td>" . $product['name'] . "</td>
                                <td>
                                    <p class=\"current-price\">RM " . $product['promo_price'] . "</p>
                                    <del class=\"old-price \">RM " . $product['price'] . "</del>
                                    <p class=\"discount\">-$prod_rate%</p>
                                </td>
                                <td class=\"text-centerx\">$qty[$loop]</td>
                            </tr>";
            $loop++;
        }

        echo "</table>";
        echo "</div>";

        /*-----------------------------------------------------------------------------*/
        /*-----------------------------------Delivery----------------------------------*/
        /*-----------------------------------------------------------------------------*/
        echo "<div id='delivery' class='bg-light my-3 container-fluid overflow-auto ' style='height: 300px;margin-left: 30px;width: 97%'>
                        <h1 class='text-center my-3'>DELIVERY</h1>
                        <hr style=\"border: 2px solid darkgrey\">";
        /*Get all delivery company detail from database*/
        $sql = "SELECT * FROM delivery";
        $result = mysqli_query($conn, $sql);
        echo "
                                <form method='post' action='' onsubmit=''>
                                   <table >
                                        <!--Table header-->
                                        <tr>
                                           <th style='width: 5%'></th>
                                           <th style='width: 5%'>No.</th>
                                           <th style='width: 20%'>Logo</th>
                                           <th style='width: 40%'>Company Name</th>
                                           <th style='width: 30%'>Delivery Fees</th>
                                        </tr>
                                        <!--end-Table header-->
                                        
                                        
                            ";
        $no = 1;
        /*Show all company detail and let customer choose the delivery company they want*/
        while ($rows = mysqli_fetch_assoc($result)) {
            printf("
                                         <tr>
                                             <td><input type='checkbox' id='delivery%d' name='delivery' value='%d' onclick='this.form.submit()'></td>
                                             <td>%d.</td>
                                             <td><img src='Admin/image/%s' alt='%s' width='100' height='80'></td>
                                             <td>%s</td>
                                             <td>RM %.2f</td>
                                         </tr>
                                            ",$rows['delivery_id'], $rows['delivery_id'], $no++, $rows['delivery_company_image'], $rows['delivery_company'], $rows['delivery_company'], $rows['delivery_price']);
        }
        echo "
                                    </table>
                                </form>
                            ";
        echo "</div>";

        /*-----------------------------------------------------------------------------*/
        /*-------------------------------end-Delivery----------------------------------*/
        /*-----------------------------------------------------------------------------*/
        echo "</div>";

        /*-----------------------------------------------------------------------------*/
        /*-------------------------------Order-Detail----------------------------------*/
        /*-----------------------------------------------------------------------------*/
        $ccrID = $_SESSION['uid']; // current user id that login
        $sql = "SELECT * FROM user_info WHERE user_id = '$ccrID' ";
        $run_query = mysqli_query($conn, $sql);
        $userInfo = mysqli_fetch_assoc($run_query);
		if(!empty($ccrID)){
			
		}else{
	
		}

        echo "<div class=\"col-4 order-detail bg-light position-relative m-0 p-0 text-center h-100 \">
                        <div class=\"detail-header\">Order Detail</div>
                        <!--Order Detail Body-->
                        <div class=\"detail-body\">
                            <h3 class=\"text-left\">Billing and Shipping</h3>
                            <ul class=\"user-information\">";
							if(!empty($ccrID)){
								echo "
                                <li><i class=\"fa fa-user\"></i> " . $userInfo['last_name'] . "&nbsp;" . $userInfo['first_name'] . "
                                    <span><a href=\"#edit-name\" data-toggle=\"data\">Edit</a></span>
                                </li>
            
                                <li>
                                    <div  style=\"width: 80%;float:left \"><i class=\"fa fa-map-marker\"></i>" . $userInfo['address'] . "</div>
                                    <div class=\"float-right\"><a href=\"\">Edit</a></div>
                                </li>
            
                                <li><i class=\"fa fa-phone\"></i>" . $userInfo['mobile'] . "
                                    <span><a href=\"\">Edit</a></span>
                                </li>
            
                                <li><i class=\"fa fa-envelope\"></i>" . $userInfo['email'] . "
                                    <span><a href=\"\">Edit</a></span>
                                </li> ";
							}else{
								echo "
                                <li><i class=\"fa fa-user\"></i> " . $userInfo['last_name'] . "&nbsp;" . $userInfo['first_name'] . "
                                    <span><a href=\"#edit-name\" data-toggle=\"data\">Edit</a></span>
                                </li>
								
                                <li>
                                    <div style=\"width: 80%;float:left \"><i class=\"fa fa-map-marker\"></i>" . $userInfo['address'] . "</div>
                                    <div class=\"float-right\"><a href=\"\">Edit</a></div>
                                </li>
            
                                <li><i class=\"fa fa-phone\"></i>" . $userInfo['mobile'] . "
                                    <span><a href=\"\">Edit</a></span>
                                </li>
            
                                <li><i class=\"fa fa-envelope\"></i>" . $userInfo['email'] . "
                                    <span><a href=\"\">Edit</a></span>
                                </li> ";
								
							}
							
		echo "
                            </ul>
            
                            <div class=\"order-summary text-left\">Order Summary</div>
                            <ul class=\"order-total\">
                                <li>
                                    Subtotal (" . $totalProd . " items)
                                    <span>RM " . $subTotal . "</span>
                                </li>
            
                                <li>
                                    Shipping Fee
                                    <span>".(isset($_POST['delivery'])?'RM '.$dlvy_price : 'No Shipping Method Selected')."</span>
                                </li>
            
                                <li>
                                    Total
                                    <span>RM " . $totalAmt . "</span>
                                </li>
           
                            </ul>
                        </div>
                     <div>";
        /*-----------------------------------------------------------------------------*/
        /*-----------------------------end-Order-Detail--------------------------------*/
        /*-----------------------------------------------------------------------------*/

        /*Pass needed value to payment page*/
        $_SESSION['totalProd'] = $totalProd;
        $_SESSION['totalAmt'] = $totalAmt;
        echo "      
                            <input type='submit' id='ckSubmit' name=\"order-submit\" class=\"detail-footer\" value='Check-out'>
                         <!--end-Pass value to payment page after submit-->
                        </div>
                    </div>";
        echo "</div>";
        echo "</form>";
        /*end-order form*/
        echo "</div>";
    }else { // If not access from cart or product page
        echo "<meta http-equiv=\"refresh\" content=\"2; url=index.php\">";
        echo "<div class='error' style='font-size: 20px;'><strong>Illegal Access! </strong> Auto return to Main Page after 2 second.</div>";
    }



?>
<?php include('footer.php'); ?>
