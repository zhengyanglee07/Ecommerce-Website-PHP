<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Delivery Addition Page</title>
        <link type="text/css" href="dashboard/dashboard.css" rel="stylesheet">
        <link type="text/css" href="style.css" rel="stylesheet">
        <script src="AdminJava.js"></script>
  
    </head>

    <body>
        <?php require_once('header.php');?>

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
                          
                            <li class="nav-item">
                                <a class="nav-link" href="Admin_Order.php">
                                    <span data-feather="file"></span>
                                    Orders
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
                                <a class="nav-link active" href="#">
                                    <span data-feather="truck"></span>
                                    Delivery
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h1"><i data-feather="shopping-cart" style=" width: 45px; height: 45px; margin-left: 10px; margin-right: 20px; margin-top: 20px;"></i>Product</h1>
                        
                    </div>


                    <h2 style=" margin-top: 2em;">Delivery Company Additional</h2>
                    <div style="font-size: 1.2em; font-family: cursive; margin-top: 35px; position: relative;" border='0' cellpadding='10' cellspacing='0'>
                        <?php
                            require_once('AdminHelper.php');
                            $dName = '';
                            $dImage = '';
                            $dPrice = '';
                            
                            if(isset($_POST['add'])){
                                
                                $dName = $_POST['deliveryName'];
                                $dImage = $_FILES['deliveryImage'];
                                $dPrice = $_POST['deliveryPrice'];
                                
                                $error['deliveryName'] = validationProdName($dName);
                                $error['deliveryPrice'] = validationPrice($dPrice);
                                $error = array_filter($error);
                                
                                if(empty($error))
                                {
                                    $save_asName = validationImage($dImage);
                                    $sql = "INSERT INTO delivery (delivery_company, delivery_price, delivery_company_image)"
                                            . " VALUES ('$dName','$dPrice','$save_asName')";
                                    
                                    $result = mysqli_query($con, $sql);
                                    
                                    if(mysqli_affected_rows($con) > 0)
                                    {
                                        printf('<div class="info">'
                                                 . 'The Delivery Company <strong>%s</strong> has been inserted into the database. '
                                                 . '[<a href="Admin_DeliveryList.php">Back to the Delivery List</a>]'
                                                 . '</div>',$dName);
                                        
                                        $dImage = null;
                                        $dName = null;
                                        $dPrice = null;
                                    }
                                    else
                                    {
                                        echo '<div class="error">'
                                         . 'OOPPSS. Databased issue. The record has not inserted into the databased.'
                                         . '</div>';
                                    }
                                }
                                else
                                 {
                                     echo '<ul class="error">';
                                     foreach ($error as $value) {
                                         echo "<li>$value</li>";
                                     }
                                     echo '</ul>';
                                 }
                            }
                        ?>

                        <form action="" method="post" enctype="multipart/form-data">  
                            <table style="display: block; margin: 20px auto 20px auto; border: solid black 1px; padding: 2%"> 
                                <tr>
                                    <td><label for="deliveryName" style=" margin-top: 20px;">Delivery Name : </label></td>
                                    <td><input type="text" name="deliveryName"></td>
                                </tr>
                                <tr>
                                    <td><label for="deliveryImage" style=" margin-top: 20px;">Delivery Company Image : </label></td>
                                    <td><input type="file" name="deliveryImage"></td>
                                </tr>
                                <tr>
                                    <td><label for="deliveryPrice" style=" margin-top: 20px; margin-bottom: 3em;">Delivery Price : </label></td>
                                    <td><input type="text" name="deliveryPrice"></td>
                                </tr>
                                <tr>
                                    <td><input type="button" name="re-generate" value="Re-generate" onclick="location='<?php echo $_SERVER['PHP_SELF']?>'" ></td>
                                    <td><input type="submit" name="add" value="Add Delivery Company"></td>
                                </tr>
                            </table>       
                        </form>
						<a href="Admin_ProductList.php"><button type="button" class="btn btn-secondary btn-block" font-weight: 500" style="margin-bottom: 5em;">Back To List</button></a>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard/dashboard.js"></script>
    </body>
</html>