<?php
$PAGE_TITLE = "My Order";
include("header.php");

/*Select for order view*/
/*  --------------------
    | No | View        |
    --------------------
    |  0 | All         |
    |  1 | To Pay      |
    |  2 | To Ship     |
    |  3 | To Receive  |
    |  4 | To Review   |
    -------------------- */
global $select;
unset($_SESSION['ckOUT']);
/*Show all if no select get from user*/
if (!isset($_GET['select'])) {
    $select = 0;
} else {
    $select = $_GET['select'];
}


include_once "helpher.php";
if ($select == 0) {
    $orderID = getAllOrdID();
} else if ($select == 1) {
    $orderID = getByOrder('CF', 'X', 'X');
    if (empty($orderID)) {
        $orderID[0] = checkOrderID("CF", "UP", "UF");
    }
} else if ($select == 2) {
    $orderID = getByDelivery('UF', 'SG', 'X', 'X', 'X', 'X', 'X');
    if (empty($orderID)) {
        $orderID[0] = checkOrderID("CT", "PD", "SG");
    }
} else if ($select == 3) {
    $orderID = getByDelivery('X', 'SD', 'AD', 'X', 'X', 'X', 'X');
    if (empty($orderID)) {
        $orderID[0] = checkOrderID("CT", "PD", "AD");
    }
}


?>
<div class="section section-shadow container-fluid bg-light">
    <ul class="link-effect text-left">
        <li class="link"><a href="myOrder.php?select=0">All</a></li>
        <li class="link"><a href="myOrder.php?select=1">To Pay</a></li>
        <li class="link"><a href="myOrder.php?select=2">To Ship</a></li>
        <li class="link"><a href="myOrder.php?select=3">To Receive</a></li>
        <li class="link"><a href="myOrder.php?select=4">To Review</a></li>
    </ul>
    <hr style="border: 2px solid darkgrey">

    <div class="container-fluid">
        <?php
        $index1 = 0;
        if (isset($orderID) && $orderID[0] != 0) { // existing of order in database
            foreach ($orderID as $oid) {
                $uid = $_SESSION['uid'];
                $total = 0.00;
                $index2 = 0;
                $prod = getOrderProd($oid, $uid);
                echo "
                <div class='py-2 ' style='background-color: #7abaff'>
                    <form action=\"payment.php\" method=\"post\">
                        <table border=\"0\" cellspacing=\"5\" cellpadding=\"10\" class='w-100 table-hover table-light'>
                            <thead>
                                <th colspan='4' class='text-left'><strong  style='font-size: 30px;'>Order ID : $orderID[$index1]</th>
                                <td>" . payment_status($prod[$index2]['payment_status']) . "</h2></td>
                           </thead>";
                echo "<tr><td class='' colspan='5'><hr style='border: 1px solid #1d78cb;'></td></tr>";
                for ($i = 0; $i < sizeof($prod); $i++) {
                    $image = explode(",", $prod[$i]['image']);
                    echo "
     
                            <tr>
                                <td><img src='Admin/Product%20Image/$image[0]' width='200px' height='200px'></td>
                                <td>" . $prod[$i]['name'] . "</td>
                                <td>" . $prod[$i]['desc'] . "</td>
                                <td>" . $prod[$i]['promo_price'] . "</td>
                                <td>" . $prod[$i]['orderQty'] . "</td>
                            </tr>
                            <thead>";
                    $total += $prod[$i]['promo_price'] * $prod[$i]['orderQty'];
                    $index2++;

                }
                if ($prod[0]['order_status'] == "CT") {
                    printf("<tr><td colspan='5' class='text-right'><button class='btn-info status py-1' style='border-radius: 25px; width: 150px;'>%s</button></td></tr>", delivery_status($prod[0]['delivery_status']));
                    echo "<tr><td colspan='5'><hr style='border: 1px solid #1d78cb;'></td></tr>";
                    echo "<tr><td colspan='5' class='text-right'><h2><strong>Item: " . $i . " , Total: " . $total . "</strong></h2></td></tr>";
                } else {
                    if (isset($_POST['cancelBTN'])) {
                        deleteOrderProd($oid);
                    }
                    printf("<tr><td colspan='5' class='text-right'><button class='btn-info status py-1' style='border-radius: 25px;  width: 150px;'>%s</button></td></tr>", order_status($prod[0]['order_status']));
                    echo "<tr><td colspan='5'><hr style='border: 1px solid #1d78cb;'></td></tr>";
                    echo "  <tr><td colspan='5' class='text-right'><h2><strong>Item: " . $i . " , Total: " . $total . "</strong></h2></td></tr>
                            <tr>
                                <td colspan='5' class='text-right '>
                                <input type='submit' formaction='' name='cancelBTN' class='btn-danger status p-3' style='border-radius: 20px 0 0 40px;  width: 150px;' value='Cancel'>
                                <input type='submit' name='payOrder' class='btn-success status p-3' style='border-radius: 0 40px 20px 0;  width: 150px;' value='Pay Now'></td>
                            </tr>";
                }
                echo "
                            
                            </thead>
                        </table>
                    </form>
                </div>
                ";
                $index1++;
            }
        } else { // Not order found from database
            echo "<div class='text-center'>
                        <img src='img/icon/noOrder.png' width='500' height='300'>
                        <h2>No Order Placed Yet.</h2>
                        <button class='btn btn-warning'>Continue Shopping</button>
                  </div>";
        }
        ?>


    </div>

</div>

<?php include("footer.php"); ?>
