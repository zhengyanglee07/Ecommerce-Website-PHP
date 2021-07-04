<?php
include_once "helpher.php";
/*Delete product added to cart after checkout and pay*/
if (isset($_POST['orderID'])) {
    $orderID = $_POST['orderID'];
    $prod = getOrderProd($orderID, $_SESSION['uid']);
    for ($j = 0; $j < sizeof($prod); $j++) {
        $pID = "cart" . $prod[$j]['id'];
        $pqty = $prod[$j]['orderQty'];
        if (isset($_COOKIE["$pID"])) {
            setcookie($pID, $pqty, time() - 1, "/");
        }
    }
    $_SESSION['orderid'] = $orderID;
    header("Location: order-success.php?orderID=" . $orderID . "&reload=Y");
}


$PAGE_TITLE = "Pay Successful";
include('header.php');
include("database.php");

/* Store all the bank info after submit from payment page*/
if (isset($_POST['paynow']) || isset($_GET['reload'])):
    if (isset($_GET['reload'])) { // if reload page after pay
        $orderID = $_GET['orderID'];
    } else {
        $orderID = $_POST['orderID'];
    }
    $uid = $_SESSION['uid'];
    $delivery = $_SESSION['delivery'];
    $totalProd = $_SESSION['totalProd'];
    $totalAmt = $_SESSION['totalAmt'];

    $sql = "SELECT * FROM orders_info WHERE order_id ='$orderID' AND user_id = '$uid'";
    $result = mysqli_query($conn, $sql);
    if (!$result || mysqli_num_rows($result) == 0 || isset($_GET['reload'])):
        if (!isset($_GET['reload'])) {
            $cName = $_POST['cName'];
            $cardNo = $_POST['cardNo'];
            $expDate = $_POST['expDate'];
            $cvv = $_POST['cvv'];
            $trxID = $_POST['trxID'];
            $_SESSION['trx'] = $trxID;
            $sql = "INSERT INTO orders_info(order_id, user_id, delivery_id, cardname, cardnumber, expdate, prod_count, total_amt, cvv)
                    VALUES ('$orderID', '$uid', '$delivery', '$cName', '$cardNo','$expDate' ,'$totalProd', '$totalAmt', '$cvv')";
            $result = mysqli_query($conn, $sql);
        }
        /*If insert successful, remove other product in same order that has been checkout but without pay*/
        if (mysqli_affected_rows($conn) > 0 || isset($_GET['reload'])):
            if (!isset($_GET['reload'])) { // No remove product if checkout from my order
                if (empty($_SESSION['payOrder'])) {
                    $sql = "SELECT * FROM order_products";
                    $result = mysqli_query($conn, $sql);
                    $prodID[] = $_SESSION['prodID'];
                    /*Remove product have been checkout but haven't pay*/
                    while ($rows = mysqli_fetch_assoc($result)) {
                        for ($i = 0; $i < sizeof($prodID[0]); $i++) {
                            if ($rows['order_id'] == $orderID && $rows['product_id'] != $prodID[0][$i]) {
                                removeOrderProd($orderID, $prodID[0][$i]);
                            }
                        }
                    }
                }
                $prod = getOrderProd($orderID, $_SESSION['uid']);
                for ($i = 0; $i < sizeof($prod); $i++) {
                    $pID = $prod[$i]['id'];
                    $new = $prod[$i]['qty'] - $prod[$i]['orderQty'];
                    updateProd($prodID[0][$i], $new);
                }
                updateOrder($orderID, 'CT', 'PD', 'SG');


            } else {
                unset($_SESSION['payOrder']);
            }
            ?>
            <div class="section section-bgColor section-shadow text-center">
                <h1 style="color: green">Payment Succesful !</h1>
                <h2>Thank you! Your payment of RM <?php echo $totalAmt ?> has been received </h2>

                <h3>Order ID: <?php echo $orderID ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Transaction
                    ID: <?php echo $_SESSION['trx'] ?></h3>

                <hr style="border: 1px solid black">
                <h4>Payment Detail</h4>
                <hr style="border: 1px solid black">
                <p>Total amount: RM <?php echo $totalAmt ?></p>
                <p> Pay via credit/debit card</p>

                <button onclick="location='index.php'" class="btn btn-info">Back To Homepage</button>
                <button class="btn btn-success" onclick="location='myOrder.php'">View Order Status</button>
            </div>

        <?php
        else:
            echo "<meta http-equiv=\"refresh\" content=\"2; url=payment.php\">";
            echo "<div class='error'>Payment Failed! Please try again.<br>Auto return to payment page after 2 second</div>";
        endif;
    else:
        echo "<div class='error'>No Payment available!</div>";
    endif;
endif; ?>

<?php include('footer.php'); ?>
