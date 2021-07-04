<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Order List Page</title>
        <link type="text/css" href="dashboard/dashboard.css" rel="stylesheet">

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
                    <h2 style=" margin-top: 2em;">Order List</h2>
                                
                    <div class="table-responsive">
                        <table class="table table-bordered table-dark" style=" border: solid black 1px; margin-top: 50px; text-align: center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Order ID</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Delivery Status</th>
                                    <th>Transaction ID</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    include_once('AdminHelper.php');
                                    
                                    $sql = "SELECT o.order_id,o.user_id,o.trx_id,o.order_status,o.payment_status,o.delivery_status,op.qty,op.amt
                                            FROM order_products op, orders o
                                            WHERE op.order_id = o.order_id
                                            ORDER BY user_id asc";
                                    
                                    $result = mysqli_query($con, $sql);
                                    
                                    while ($row = mysqli_fetch_array($result))
                                    {
                                        $orderTitle = validationOrderStatusTitle($row['order_status']);
                                        $orderStyle = validationOrderStatusStyle($row['order_status']);
                                        $paymentTitle = validationPaymentStatus($row['payment_status']);
                                        $paymentStyle = validationPaymentStyle($row['payment_status']);
                                        $deliveryTitle = validationDeliveryStatus($row['delivery_status']);
                                        $deliveryStyle = validationDeliveryStyle($row['delivery_status']);

                                        printf('<tr>'
                                                . '<td>%d</td>'
                                                . '<td>%d</td>'
                                                . '<td><button type="button" id="order" class="btn btn-%s" style=" width: 100px;font-weight: 500">%s</button></td>'
                                                . '<td><button type="button" class="btn btn-%s" style=" width: 100px;font-weight: 500">%s</button></td>'
                                                . '<td><button type="button" class="btn btn-%s" style=" width: 100px;font-weight: 500">%s</button></td>'
                                                . '<td>%s</td>' 
                                                . '<td><a href="Admin_ViewOrder.php?viewOrder=%d"><button type="button"class="btn btn-light" style=" width: 100px;font-weight: 500">View</button></a></td>'
                                                . '<td><a href="Admin_EditOrder.php?viewOrder=%d"><button type="button"class="btn btn-primary" style=" width: 100px;font-weight: 500">Edit</button></a></td>'
                                                . '</tr>'
                                            ,$row['user_id'],$row['order_id'],$orderStyle,$orderTitle,$paymentStyle,$paymentTitle,$deliveryStyle,$deliveryTitle,$row['trx_id']
                                            ,$row['order_id']
                                            ,$row['order_id']);
                                    }     
                                    mysqli_free_result($result);
                                    mysqli_close($con);
                                ?>
                            </tbody>
                        </table>
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