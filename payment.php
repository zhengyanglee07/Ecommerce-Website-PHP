<?php
$PAGE_TITLE = "Payment";
include('header.php');
include("database.php");

global $orderID;
include_once "helpher.php";
if (isset($_SESSION['ckOUT'])) {
    /*Create an order id and transaction id  after check-out*/
    $trx = createTRXID();
    $oid = (int)createOrdID();
    $uid = $_SESSION['uid'];
    /*Check for current user whether have an order haven't pay.*/
    $order = "SELECT * FROM orders O, user_info U WHERE O.user_id = '$uid' AND O.user_id = U.user_id AND O.order_status = 'CF' ";
    $run_query = mysqli_query($conn, $order);
    /*Only create an new order if current user no have order before or pending order */
    if (mysqli_num_rows($run_query) == 0) {
        /*Create the new Order*/
        $sql = "INSERT INTO orders (order_id, user_id, trx_id, order_status, payment_status, delivery_status) VALUES('" . $oid . "','$uid','$trx', 'CF' , 'UP' , 'UF' )";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo $result . mysqli_error($conn);
            echo "<div class='error'>Sorry! Failed to add new Order. Please try again.</div>";
        }
    }

    /*Check the order id of current user.*/
    $orderID = checkOrderID('CF', 'UP', 'UF');

    $total = 0.00;
    $pID[] = $_SESSION['prodID'];
    $pQTY[] = $_SESSION['qty'];
    for ($i = 0; $i < sizeof($pID[0]); $i++) {
        $checkExist = "SELECT * FROM order_products where order_id = '$orderID' AND product_id = " . $pID[0][$i] . " ";
        $check = mysqli_query($conn, $checkExist);

        /*Calculate total*/
        $checkPrice = mysqli_query($conn, "SELECT * FROM products where product_id =" . $pID[0][$i] . " ");
        while ($row = mysqli_fetch_array($checkPrice)) {
            $total = $row['product_promo_price'] * $pQTY[0][$i];
        }

        if (!$check || mysqli_num_rows($check) == 0) {
            addOrderProd($orderID, $pID[0][$i], $pQTY[0][$i], $total);
        } else {
            $result = mysqli_fetch_assoc($check);
            if ($result['qty'] != $pQTY) {
                updateOrderProd($orderID, $pID[0][$i], $pQTY[0][$i], $total);
            }
        }
    }
} else if (isset($_POST['payOrder'])) {
    /*Get order id which haven't pay yet*/
    $orderID = checkOrderID('CF', 'UP', 'UF');
    $prod = getOrderProd($orderID);

    /*Calculate total*/
    $totalAmt = 0.0;
    for ($i = 0; $i < sizeof($prod); $i++) {
        $checkExist = "SELECT * FROM order_products where order_id = '$orderID' AND product_id = " . $prod[$i]['id'] . " ";
        $check = mysqli_query($conn, $checkExist);


        $total = $prod[$i]['promo_price'] * $prod[$i]['orderQty'];
        $totalAmt += $total;

        if (!$check || mysqli_num_rows($check) == 0) {
            addOrderProd($orderID, $prod[$i]['id'], $prod[$i]['orderQty'], $total);
        } else {
            $result = mysqli_fetch_assoc($check);
            if ($result['qty'] != $prod[$i]['orderQty']) {
                updateOrderProd($orderID, $prod[$i]['id'], $prod[$i]['orderQty'], $total);
            }
        }
    }
    $trx = $prod[0]['trx'];
    $_SESSION['totalProd'] = $i;
    $_SESSION['totalAmt'] = $totalAmt;
    $_SESSION['payOrder'] = "yes";


}


?>
<!--Section-->
<div class="section">
    <!--Back button-->
    <form action="checkout.php" method="post">
        <button type='submit' name='back' class="bt btn-info back-btn"><i class="fa fa-arrow-left">Back&nbsp;</i>
        </button>
    </form>
    <!--end-back button-->

    <!--Payment-->
    <div class="place-order row bg-white">
        <div class="order-payment col-8">
            <h3>Select Payment Method</h3>
            <!-- payment tab nav -->
            <ul class="link-effect payMethod nav nav-tabs p-0 m-0">
                <li style="width: 200px; height: 200px;">
                    <a data-toggle="tab" href="#tab01" role="tab"> <img src="img/icon/credit-debit.jpg">Credit/Debit
                        Card</a>
                </li>
                <li style="width: 200px; height: 200px;">
                    <a data-toggle="tab" href="#tab02" role="tab"><img src="img/icon/onlinebanking.png">Online Bank</a>
                </li>
            </ul>
            <!-- end-payment tab nav -->

            <!-- payment tab content -->
            <div class="tab-content">
                <!-- tab1  -->
                <div id="tab01" class="tab-pane fade in" role="tabpanel">
                    <div>
                        <div>
                            <h5 style="margin: 30px 0 0 0; font-size: 20px"></h5>
                            <ul class="payment-method-icon">
                                <li>Accept Card</li>
                                <li><i class="fa fa-credit-card"></i></li>
                                <li><i class="fa fa-cc-mastercard"></i></li>
                                <li><i class="fa fa-cc-visa"></i></li>
                            </ul>
                        </div>

                        <div>
                            <form method="post" action="order-success.php">
                                <table cellpadding="5px;" class="creditOrdebit">
                                    <tr>
                                        <td><label for="name">Name on card</label><br>
                                            <input type="text" name="cName"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="cardNo">Card Number</label><br>
                                            <input type="text" name="cardNo"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="expDate">Experied Date</label><br>
                                            <input type="text" name="expDate" placeholder="12/22" maxlength="5">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="cvv">CVV</label><br>
                                            <input type="text" name="cvv" maxlength="3"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="orderID" value="<?php echo $orderID ?>">
                                        <input type="hidden" name="trxID" value="<?php echo $trx ?>">
                                        <td colspan="2"><input type="submit" name="paynow" class="btn btn-success w-100"
                                                               value="Pay Now"></td>
                                    </tr>
                                </table>
                            </form>

                        </div>
                    </div>
                </div>
                <!--end-tab1-->

                <!-- tab2  -->
                <div id="tab02" class="tab-pane fade in " role="tabpanel">
                    <div class="row">
                        <div class="col-md-12 pay-online">
                            <div><a href="s.hongleongconnect.my/rib/app/fo/login?web=1"><img
                                            src="img/icon/hongleong.jpg" alt="hong leong bank"></a></div>
                            <div><a href="https://www.ambank.com.my/eng/online-banking"><img src="img/icon/ambank.png"
                                                                                             alt="am bank"></a></div>
                            <div>
                                <a href="www2.pbebank.com/myIBK/apppbb/servlet/BxxxServlet?RDOName=BxxxAuth&MethodName=login"><img
                                            src="img/icon/pbe.jpg" alt="public bank"></a></div>
                        </div>
                    </div>
                </div>
                <!--end-tab2-->
            </div>
            <!--end-payment tab-content-->
        </div>
        <!--end-Payment-->

        <!--order summary-->
        <div class="order-summary col-4 bg-light">
            <h3>ORDER SUMMARY</h3>
            <div class="position-relative">
                Subtotal (<?php echo $_SESSION['totalProd'] ?>) items and shipping included)
                RM <?php echo $_SESSION['totalAmt'] ?>
                <hr style="border: 1px solid black">
                <div class="left d-md-inline-block " style="width: 50%; font-size: 25px;">
                    Total Amount:
                </div>
                <span class="current-price text-right"
                      style="font-size: 27px; font-weight: bold">RM <?php echo $_SESSION['totalAmt'] ?></span>
            </div>
        </div>
        <!--end-Order summary-->
    </div>
    <!--end-Payment-->
</div>
<!--end-Section-->
<?php include('footer.php'); ?>
