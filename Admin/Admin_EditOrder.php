<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Edit Order Page</title>
        <link type="text/css" href="dashboard/dashboard.css" rel="stylesheet">
        <link type="text/css" href="style.css" rel="stylesheet"/>   
        <script type="text/javascript" src="AdminJava.js"></script>
    </head>
    <body>
        <?php require_once('header.php');?>
        

        <div class="container-fluid" style=" margin-top: 50px;">
            <div class="row" style=" margin-top: 50px;">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li>
                                <a>
                                    <img src="image/logo.png" style="width: 150px; height: 150px;"/>
                                    <span style=" color:">Noble Phoenix</span>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link active" href="Admin_Order.php">
                                    <span data-feather="file"></span>
                                    Orders<span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Admin_ProductList.php">
                                    <span data-feather="shopping-cart"></span>
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Admin_Customer.php">
                                    <span data-feather="users"></span>
                                    Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Admin_DeliveryList.php">
                                    <span data-feather="truck"></span>
                                    Delivery
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h1"><span data-feather="file-text" style=" width: 45px; height: 45px; margin: 20px 20px 0px 10px;"></span>Order</h1>

                    </div>
                    <h2 style=" margin-top: 2em; margin-bottom: 1.5em;">Edit Order</h2>
                                
                    <div class="table-responsive">      
                                <?php
                                global $oID;
                                    $hideform = true;
                                    include_once('AdminHelper.php');
                                        $orderID = $_GET['viewOrder'];
                                        if($_SERVER['REQUEST_METHOD'] == 'GET')
                                        {
                                            
                                            $orderID = mysqli_real_escape_string($con, $orderID);
                                            $sql = "SELECT o.order_id,o.user_id,o.trx_id,o.order_status,o.payment_status,o.delivery_status,op.qty,op.amt
                                                    FROM order_products op, orders o
                                                    WHERE op.order_id = o.order_id AND op.order_id = '$orderID'";

                                            $result = mysqli_query($con, $sql);

                                            if(mysqli_num_rows($result) > 0){
                                                $hideform = false;
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    $oID = $row['order_id'];
                                                    $uID = $row['user_id'];
                                                    $trxID = $row['trx_id'];
                                                    $orderTitle = validationOrderStatusTitle($row['order_status']);
                                                    $orderStyle = validationOrderStatusStyle($row['order_status']);
                                                    $paymentTitle = validationPaymentStatus($row['payment_status']);
                                                    $paymentStyle = validationPaymentStyle($row['payment_status']);
                                                    $deliveryTitle = validationDeliveryStatus($row['delivery_status']);
                                                    $deliveryStyle = validationDeliveryStyle($row['delivery_status']);
                                                    $qty = $row['qty'];
                                                    $amt = $row['amt'];   
                                                    
                                                }
                                            }
                                            else
                                            {
                                                $hideform = true;
                                                echo '<div class="error"><img src="image/warning_sign2.png" style="width="20px" height="20px""><b> Warning : </b> OOPSSS..... Not Record inside.</div>';
                                                     }
                                        }
                                        else
                                        {
                                             $orderStatus = trim($_POST['orderS']);
                                             $paymentStatus = trim($_POST['paymentS']);
                                             $deliveryStatus = trim($_POST['deliveryS']);

                                             $sql = "UPDATE orders "
                                                   . "SET order_status = '$orderStatus', payment_status = '$paymentStatus', delivery_status = '$deliveryStatus'"
                                                   . "WHERE order_id = '$orderID'";

                                             $result = mysqli_query($con, $sql);

                                           if(mysqli_affected_rows($con) > 0)
                                           {
                                               $hideform = true;
                                               $check = true;
                                               echo '<script>'
                                               . 'alert("Update Successfull !!!");'
                                               . 'window.open("Admin_Order.php","_self")'
                                                       . '</script>';
                                               header("Refresh: 1; url=Admin_Order.php");
                                           }
                                           else{
                                               echo '<script>
                                                   alert("The data is no changed because the data is same.");
                                                          window.onload = function(){
                                                          window.history.go(-2);
                                                        }
                                                        </script>';
                                           }
                                        }
                                    if($hideform == false):
                                ?>
                        <form action="" method="post">
                        <table border="1" cellspacing="0" cellpadding="10" style="width:100%; border-collapse: collapse; font-family: Tahoma; font-size: 15px; background-color: #333333; color: white; font-weight: 750px;">
                            <tr>
                                    <td>Order ID </td>
                                    <td><?php echo $oID?></td>
                                </tr>
                                <tr>
                                    <td>User ID </td>
                                    <td><?php echo $uID?></td>
                                </tr>
                                <tr>
                                    <td>Transaction ID </td>
                                    <td><?php echo $trxID?></td>
                                </tr>
                                <tr>
                                    <td>Order ID </td>
                                    <td><?php echo $oID?></td>
                                </tr>
                                <tr>
                                    <td>Order Status </td>
                                    <td>
                                        <select name="orderS" id="orderS">
                                            <option value="CF">Confirmed</option>
                                            <option value="CT">Completed</option>
                                            <option value="CC">Cancelled</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Payment Status </td>
                                    <td>
                                        <select name="paymentS" id="paymentS">
                                            <option value="UP">Unpaid</option>
                                            <option value="FD">Failed</option>
                                            <option value="EP">Expired</option>
                                            <option value="PD">Paid</option>
                                            <option value="RG">Refunding</option>
                                            <option value="RD">Refunded</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Delivery Status </td>
                                    <td>
                                        <select name="deliveryS" id="deliveryS">
                                            <option value="UF">Unfulfilled</option>
                                            <option value="SG">Shipping</option>
                                            <option value="SD">Shipped</option>
                                            <option value="AD">Arrived</option>
                                            <option value="CL">Collected</option>
                                            <option value="RG">Returning</option>
                                            <option value="RD">Returned</option>
                                        </select>
                                    </td>                                </tr>
                                <tr>
                                    <td>Quantity </td>
                                    <td><?php echo $qty?></td>
                                </tr>
                                <tr>
                                    <td>Amount </td>
                                    <td><?php echo $amt?></td>
                                </tr>
                            </tbody>
                        </table>  
                            <a href="Admin_Order.php"><input type="button" name="backList" value="Back to List" style="width: 130px; height: 40px; font-size: 15px; font-weight: 500; border-radius: 5%; background-color: #999999; color:  white; margin-top: 1.5em; float: left;"></a>
                            <input type="submit" name="update" value="Update" style="width: 130px; height: 40px; font-size: 15px; font-weight: 500; border-radius: 5%; background-color:  #009933; color:  white; margin-top: 1.5em; float:  right;">
                        </form>
                        <?php endif;?>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard/dashboard.js"></script></body>
</html>