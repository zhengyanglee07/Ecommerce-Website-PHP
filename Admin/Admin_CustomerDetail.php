<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link type="text/css" href="style.css" rel="stylesheet"/>
        <title>Customer Details Page</title>
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

                    <div class="table-responsive">
                                                    
                            <?php
                            require_once('AdminHelper.php');
                            $hideform;

                                $custView = $_GET['custView'];
                                $custView = mysqli_real_escape_string($con, $custView);
                                $sql = "SELECT* FROM orders_info oi, user_info ui WHERE ui.user_id = oi.user_id AND ui.user_id = '$custView'";

                                $result = mysqli_query($con, $sql);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    $hideform = false;
                                    while($row = mysqli_fetch_array($result))
                                        {
                                            $userID = $row['user_id'];
                                            $fname = $row['first_name'];
                                            $lname = $row['last_name'];
                                            $email = $row['email'];
                                            $mobile = $row['mobile'];
                                            $address = $row['address'];
                                            $city = $row['city'];
                                            $state = $row['state'];
                                            $zip = $row['zip'];
                                            
                                            $orderID = $row['order_id'];
                                            $cardname = $row['cardname'];
                                            $cardnumber = $row['cardnumber'];
                                            $expdate = $row['expdate'];
                                            $prodcount = $row['prod_count'];
                                            $totalAmt = $row['total_amt'];
                                            $cvv = $row['cvv'];
                                        }
                                }
                                else
                                {
                                    $hideform = true;
                                    echo '<div class="error"><img src="image/warning_sign2.png" style="width="20px" height="20px""><b> Warning : </b> OOPSSS..... Not Record inside.</div>';
                                }
                                    mysqli_free_result($result);
                                    mysqli_close($con);
                                    
                                if($hideform == false):
                            ?>
                            <table border="1" cellspacing="0" cellpadding="10" style="width:100%; border-collapse: collapse; font-family: Tahoma; font-size: 15px; background-color: #333333; color: white; font-weight: 750px; margin-top: 5em; margin-bottom: 5em;">
                                <h2 style="margin-top: 2em;">Customer Details</h2>
                                <tr>
                                    <td>Customer ID : </td>
                                    <td><?php echo $userID ?></td>
                                </tr>
                                <tr>
                                    <td>Customer Name  <?php printf('<td>%s %s</td>',$fname,$lname);?></td>
                                </tr>
                                <tr>
                                    <td>Customer Email : </td>
                                    <td><?php echo $email ?></td>
                                </tr>
                                <tr>
                                    <td>Customer mobile phone number : </td>
                                    <td><?php echo $mobile ?></td>
                                </tr>
                                <tr>
                                    <td>Customer Address : </td>
                                    <td><?php echo $address ?></td>
                                </tr>
                                <tr>
                                    <td>City : </td>
                                    <td><?php echo $city ?></td>
                                </tr>
                                <tr>
                                    <td>State : </td>
                                    <td><?php echo $state ?></td>
                                </tr>
                                <tr>
                                    <td>PostCode : </td>
                                    <td><?php echo $zip ?></td>
                                </tr>
                            </tbody>
                        </table>
                            <table border="1" cellspacing="0" cellpadding="10" style="width:100%; border-collapse: collapse; font-family: Tahoma; font-size: 15px; background-color: #333333; color: white; font-weight: 750px; margin-bottom: 5em;">
                                <h2 style="margin-bottom: 2em;">Customer Order Details</h2>
                                <tr>
                                    <td>Order ID :</td>
                                    <td><?php echo $orderID ?></td>
                                </tr>
                                <tr>
                                    <td>Customer Card Name :</td>
                                    <td><?php echo $cardname ?></td>
                                </tr>
                                <tr>
                                    <td>Customer Card Number :</td>
                                    <td><?php echo $cardnumber ?></td>
                                </tr>
                                <tr>
                                    <td>Expire Date :</td>
                                    <td><?php echo $expdate ?></td>
                                </tr>
                                <tr>
                                    <td>Product Count :</td>
                                    <td><?php echo $prodcount ?></td>
                                </tr>
                                <tr>
                                    <td>Total Amount :</td>
                                    <td><?php echo $totalAmt ?></td>
                                </tr>
                                <tr>
                                    <td>CVV :</td>
                                    <td><?php echo $cvv ?></td>
                                </tr>
                            </table>
                        <a href="Admin_Customer.php"><button type="button" class="btn btn-secondary btn-block" font-weight: 500" style="margin-bottom: 5em;">Back To List</button></a>
                    </div>
                </main>
                <?php endif; ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard/dashboard.js"></script></body>
</html>