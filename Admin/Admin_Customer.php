<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Customer List Page</title>
        <link type="text/css" href="dashboard/dashboard.css" rel="stylesheet">

    </head>
    <body>
        <?php require_once('header.php'); ?>

        <div class="container-fluid" style=" margin-top: 50px;">
            <div class="row">
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
                                <a class="nav-link" href="Admin_Order.php">
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
                                <a class="nav-link active" href="Admin_Customer.php">
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
                        <h1 class="h1"><i data-feather="users" style=" width: 45px; height: 45px; margin-left: 10px; margin-right: 20px; margin-top: 20px;"></i>Customer</h1>

                    </div>
                    <h2 style=" margin-top: 2em;">Customer List</h2>
                    <form action="" method="post">
                    <div style=" margin-top: 50px; margin-bottom: 15px; float: right;">
                        <input  id="search" name="search" type="text" placeholder="  Search here">
                        <button type="submit" name="searchBtn" id="search-btn" class="btn btn-outline-success" >Search</button> 
                    </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-dark" style=" border: solid black 1px; text-align: center; margin: 0px 0 20px 0;">
                            <thead>
                                <tr>
                                    <th>Customer No</th>
                                    <th>Customer Name</th>
                                    <th>Customer Gmail</th>
                                    <th>Order</th>
                                    <th>Sub Total (RM)</th>
                                    <th>View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                    require_once('AdminHelper.php');
                                    
                                    if(isset($_POST['searchBtn'])){
                                        $name = $_POST['search'];
                                        $sql = "SELECT ui.user_id, ui.first_name, ui.last_name, ui.email, oi.order_id, oi.prod_count, oi.total_amt
                                            FROM user_info ui, orders_info oi
                                            WHERE ui.user_id = oi.user_id AND first_name LIKE '%$name%'
                                            ORDER BY ui.user_id asc"; 
                                      
                                    $result = mysqli_query($con, $sql);

                                        while($row = mysqli_fetch_array($result))
                                        {
                                            printf('<tr>'
                                                    . '<td>%04d</td>'
                                                    . '<td>%s %s</td>'
                                                    . '<td>%s</td>'
                                                    . '<td>%d</td>'
                                                    . '<td>%.2f</td>'
                                                    . '<td><a href="Admin_CustomerDetail.php?custView=%d"><button type="button"class="btn btn-light" style=" width: 100px;font-weight: 500">View</button></a></td>'                                                    
                                                    .'</tr>'
                                                    ,$row['user_id'],$row['first_name'],$row['last_name'],$row['email'],$row['prod_count'],$row['total_amt']
                                                    ,$row['user_id']);
                                        }
                                    }
                                    else{
                                         $sql = "SELECT ui.user_id, ui.first_name, ui.last_name, ui.email, oi.order_id, oi.prod_count, oi.total_amt
                                            FROM user_info ui, orders_info oi
                                            WHERE ui.user_id = oi.user_id
                                            ORDER BY ui.user_id asc"; 
                                      
                                    $result = mysqli_query($con, $sql);

                                        while($row = mysqli_fetch_array($result))
                                        {
                                            printf('<tr>'
                                                    . '<td>%04d</td>'
                                                    . '<td>%s %s</td>'
                                                    . '<td>%s</td>'
                                                    . '<td>%d</td>'
                                                    . '<td>%.2f</td>'
                                                    . '<td><a href="Admin_CustomerDetail.php?custView=%d"><button type="button"class="btn btn-light" style=" width: 100px;font-weight: 500">View</button></a></td>'                                                    
                                                    .'</tr>'
                                                    ,$row['user_id'],$row['first_name'],$row['last_name'],$row['email'],$row['prod_count'],$row['total_amt']
                                                    ,$row['user_id']);
                                        }
                                    
                                    }
                                   
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