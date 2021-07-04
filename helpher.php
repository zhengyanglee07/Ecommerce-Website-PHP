<?php
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_NAME', 'noblephoenix');

function addToCart($prodId) {
    if(!isset($_SESSION['uid'])){
        echo "<script> window.onload = openLoginModal();</script>";

    }else{
        echo "<script>window.onload = SetCookie(".'cart'.$prodId.", '1') </script>";
    }
}


function getUserInfo($uid)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "SELECT * FROM user_info WHERE user_id = '$uid' ";
    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($result);

    return array("id" => $user['user_id'], "fname" => $user['first_name'], "lname" => $user['last_name'],
        "email" => $user['email'], "pswd" => $user['password'], "mobile" => $user['mobile'],
        "address" => $user['address'], "qty" => $user['city'],
        "state" => $user['state'], "zip" => $user["zip"]);
}

/*----------------------------------------------------------------------------------*/
/*--------------------------Get Product Info by ID---------------------------------*/
/*----------------------------------------------------------------------------------*/
function getProdDetail($prodID)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "SELECT * FROM PRODUCTS, CATEGORIES WHERE product_cat = cat_id AND product_id='$prodID' ";
    $result = mysqli_query($conn, $sql);
    $prod = mysqli_fetch_assoc($result);

    return array("id" => $prod['product_id'], "cat" => $prod['product_cat'], "brand" => $prod['product_brand'],
        "name" => $prod['product_title'], "desc" => $prod['product_desc'], "price" => $prod['product_price'],
        "promo_price" => $prod['product_promo_price'], "qty" => $prod['product_quantity'], "published"=> $prod['product_published'],
        "image" => $prod['product_image'], "cat_name" => $prod["cat_title"]);
}

function updateProd($prodID, $newQty)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "Update PRODUCTS SET product_quantity= '$newQty' WHERE product_id='$prodID' ";
    $result = mysqli_query($conn, $sql);

    /*To prompt if success or failed*/
    /*if ($result) {
        echo "<div class='info'>Stock update successful</div>";
    } else {
        echo "<div class='error'>Failed to update stock! Please try again</div>";
    }*/

}

function getOrderProd($orderID,$userID)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "SELECT * FROM ORDERS O, PRODUCTS P, Order_products OP WHERE OP.order_id = '$orderID' AND  O.order_id = '$orderID' AND O.user_id = '$userID' AND OP.product_id = P.product_id AND O.order_id = OP.order_id ";
    $result = mysqli_query($conn, $sql);

    $product = array();
    $index = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($prod = mysqli_fetch_assoc($result)) {
            $product[$index] = array("id" => $prod['product_id'], "name" => $prod['product_title'], "desc" => $prod['product_desc'], "price" => $prod['product_price'], "qty" => $prod['product_quantity'],
                "promo_price" => $prod['product_promo_price'], "image" => $prod['product_image'], "orderQty" => $prod['qty'], "orderAmt" => $prod['amt'],
                "order_status" => $prod['order_status'], "payment_status" => $prod['payment_status'], "delivery_status" => $prod['delivery_status'],
                "trx" => $prod['trx_id']);
            $index++;
        }
    }
    return $product;
}

function deleteOrderProd($orderID){
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    mysqli_query($conn, "DELETE FROM order_info WHERE order_id = '$orderID' ");
    mysqli_query($conn, "DELETE FROM order_products WHERE order_id = '$orderID' ");
    mysqli_query($conn, "DELETE FROM orders WHERE order_id = '$orderID' ");
    echo "<script> window.onload = function(){
                alert('Cancel Successful');
                window.location.reload(true);
               
            } 
</script>";
}

function getDelivery($deliveryID)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "SELECT * FROM delivery WHERE delivery_id='$deliveryID' ";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);

    return array("id" => $rows['delivery_id'], "company" => $rows['delivery_company'], "price" => $rows['delivery_price'], "logo" => $rows['delivery_company_image']);
}

function getCategory()
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "SELECT * FROM Categories ";
    $result = mysqli_query($conn, $sql);

    $index = 0;
    $categ = array();
    while ($rows = mysqli_fetch_assoc($result)) {
        $categ[$index] = array("id" => $rows['cat_id'], "title" => $rows['cat_title']);
        $index++;
    }
    return $categ;
}

/*Search product*/
function searchProduct($categ, $brand, $keyWord)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    if ($categ == 'X' && $brand == 'X' && $keyWord == 'X') {
        $sql = "SELECT * FROM Products";
    } else if ($categ == 'X' && $brand == 'X') { /*Only search by keyword*/
        $sql = "SELECT * FROM Products WHERE UPPER(product_keywords) LIKE '%$keyWord%' || UPPER(product_title) LIKE '%$keyWord%' ";
    } else if ($brand == 'X' && $keyWord == 'X') { /*Only search by category*/
        $sql = "SELECT * FROM Products WHERE UPPER(product_cat) = '$categ' ";
    } else if ($categ == 'X' && $keyWord == 'X') { /*Only search by brand*/
        $sql = "SELECT * FROM Products WHERE UPPER(product_brand) LIKE '%$brand%' ";
    } else if ($categ==0 && $brand == 'X'){
        $sql = "SELECT * FROM Products WHERE UPPER(product_keywords) LIKE' %$keyWord%' || product_keywords LIKE '%$keyWord%' ||  UPPER(product_title) LIKE '%$keyWord%'";
    }else if ($brand == 'X') { // search by categories and keyword
        $sql = "SELECT * FROM Products WHERE product_cat = '$categ' AND UPPER(product_keywords) LIKE' %$keyWord%' || product_keywords LIKE '%$keyWord%' ||  UPPER(product_title) LIKE '%$keyWord%'";
    } else { /*Search all product*/
        $sql = "SELECT * FROM Products";
    }

    $prodID = array();
    $result = mysqli_query($conn, $sql);
    $index = 0;
    if ($result) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $prodID[$index] = $rows['product_id'];
            $index++;
        }
    } else {
        echo '<div class="error">No product found! Please search again.</div>';
    }
    return $prodID;
}


/*----------------------------------------------------------------------------------*/
/*---------------------------------------Order--------------------------------------*/
/*----------------------------------------------------------------------------------*/
function calcSubTotal($price, $qty)
{
    return $price * $qty;
}

function createTRXID()
{
    $trxNo = mt_rand(1000000, 9999999);
    return ("trx" . $trxNo . "U" . $_SESSION['uid']);
}

function createOrdID()
{
    $idNo = mt_rand(10, 99);
    return (date("ymd") . $idNo . $_SESSION['uid']);
}

function updateOrder($orderID, $order_status, $payment_status, $delivery_status)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $uptOrder = "UPDATE orders SET order_status='$order_status',payment_status='$payment_status',delivery_status='$delivery_status' WHERE order_id = '$orderID'";
    $upt = mysqli_query($conn, $uptOrder);
    /*if ($upt) {
        echo "<div class='info'>Order Update Successful. <a>Click Here</a> to check the status</div>";
    } else {
        echo "<div class='error'>Order Update Failed. Please try again</div>";
    }*/
}

function order_status($status)
{
    $os = array("CF" => "Confirmed", "CT" => "Completed", "CC" => "Cancelled");
    return $os[$status];
}

function payment_status($status)
{
    $ps = array("UP" => "Unpaid", "FD" => "Failed", "EP" => "Expired", "PD" => "Paid", "RG" => "Refunding", "RD" => "Refunded");
    return $ps[$status];
}

function delivery_status($status)
{
    $ds = array("UF" => "Unfulfilled", "SG" => "Shipping", "AD" => "Arrived", "CL" => "Collected", "RG" => "Returning", "RD" => "Returned");
    return $ds[$status];
}

function checkOrderID($order_status, $payment_status, $delivery_status)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $orderID = 0;
    $current_orderID = "SELECT order_id from orders O, user_info U WHERE 
                        U.user_id = " . $_SESSION['uid'] . " AND order_status = '$order_status' AND
                        payment_status = '$payment_status' AND delivery_status = '$delivery_status' ";
    $result = mysqli_query($conn, $current_orderID);
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $orderID = $row['order_id'];
        }
    }
    return $orderID;
}

function getAllOrdID()
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $current_orderID = "SELECT order_id from orders O WHERE  O.user_id = " . $_SESSION['uid'] . " ";
    $result = mysqli_query($conn, $current_orderID);
    $index = 0;
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $orderID[$index] = $row['order_id'];
            $index++;
        }
    }
    return $orderID;
}

function getByOrder($cs1, $cs2, $cs3)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "SELECT * from orders O, user_info U WHERE  U.user_id = " . $_SESSION['uid'] . " AND 
                O.order_status = '$cs1' || O.order_status = '$cs2' || O.order_status = '$cs3' ";
    $result = mysqli_query($conn, $sql);
    $orderID = array();
    $index = 0;
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $orderID[$index] = $row['order_id'];
            $index++;
        }
    }
    return $orderID;
}

function getByPayment($ps1, $ps2, $ps3, $ps4, $ps5, $ps6)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "SELECT * from orders O, user_info U WHERE  U.user_id = " . $_SESSION['uid'] . " AND 
                O.payment_status = '$ps1' || O.payment_status = '$ps2' || O.payment_status = '$ps3' || O.payment_status = '$ps4' ||
                 O.payment_status = '$ps5' || O.payment_status = '$ps6'";
    $result = mysqli_query($conn, $sql);
    $orderID = array();
    $index = 0;
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $orderID[$index] = $row['order_id'];
            $index++;
        }
    }
    return $orderID;
}

function getByDelivery($ds1, $ds2, $ds3, $ds4, $ds5, $ds6, $ds7)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "SELECT * from orders O, user_info U WHERE  U.user_id = " . $_SESSION['uid'] . " AND O.user_id = U.user_id AND
                O.delivery_status = '$ds1' || O.delivery_status = '$ds2' || O.delivery_status = '$ds3' || O.delivery_status = '$ds4' ||
                 O.delivery_status = '$ds5' || O.delivery_status = '$ds6' || O.delivery_status = '$ds7' ";
    $result = mysqli_query($conn, $sql);
    $orderID = array();
    $index = 0;
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $orderID[$index] = $row['order_id'];
            $index++;
        }
    }
    return $orderID;
}

function addOrderProd($orderID, $pID, $pQTY, $total)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $addOrderProd = "INSERT INTO order_products(order_id, product_id, qty, amt) VALUES ('$orderID','$pID','$pQTY','$total')";
    $add = mysqli_query($conn, $addOrderProd);
    /*if ($add) {
        echo "<div class='info'>Order Successful. <a>Click Here</a> to check the status</div>";
    } else {
        echo "<div class='error'>Order Failed. Please try again</div>";
    }*/
}

function updateOrderProd($orderID, $pID, $pQTY, $total)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $uptOrderProd = "UPDATE order_products SET qty='$pQTY',amount='$total' WHERE order_id = '$orderID' AND product_id = '$pID'";
    $upt = mysqli_query($conn, $uptOrderProd);
    /*if ($upt) {
        echo "<div class='info'>Order Update Successful. <a>Click Here</a> to check the status</div>";
    } else {
        echo "<div class='error'>Order Update Failed. Please try again</div>";
    }*/
}

function removeOrderProd($orderID, $pID)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $delete = "DELETE FROM order_products WHERE order_id = '$orderID' AND product_id = '$pID' ";
    $dlt = mysqli_query($conn, $delete);
    /*if ($dlt) {
        echo "<div class='info'>Order Delete Successful.</div>";
    } else {
        echo "<div class='error'>Order Delete Failed. Please try again</div>";
    }*/
}


function loginStatus()
{
    if (isset($_SESSION['uid'])) {
        return true;
    } else {
        return false;
    }
}


/*--------------------------------------------------------------------------*/
/*-----------------------------Rating and Review----------------------------*/
/*--------------------------------------------------------------------------*/
function getDBResult($query, $params = array())
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = $conn->prepare($query);
    if (! empty($params)) {
        bindParams($sql, $params);
    }
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $resultset[] = $row;
        }
    }

    if (! empty($resultset)) {
        return $resultset;
    }
}

function updateDB($query, $params = array())
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = $conn->prepare($query);
    if (! empty($params)) {
        bindParams($sql, $params);
    }
    $sql->execute();

}

function bindParams($sql, $params)
{
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die ('Could not connect to MySQL: ' . mysqli_connect_error());

    $param_type = "";
    foreach ($params as $query_param) {
        $param_type .= $query_param["param_type"];
    }

    $bind_params[] = & $param_type;
    foreach ($params as $k => $query_param) {
        $bind_params[] = & $params[$k]["param_value"];
    }

    call_user_func_array(array(
        $sql,
        'bind_param'
    ), $bind_params);
}

function strLength($x, $length){
    if(strlen($x) <= $length){
        echo $x;
    }else{
        $y = substr($x, 0, $length). '...';
        echo $y;
    }
}
?>
