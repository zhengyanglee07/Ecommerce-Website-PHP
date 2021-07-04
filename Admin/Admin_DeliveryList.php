<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Delivery List Page</title>
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
                        <h1 class="h1"><span data-feather="truck" style=" width: 45px; height: 45px; margin: 15px 20px 0px 10px;"></span>Delivery</h1>

                    </div>
                    
                    <h2 style=" margin-top: 2em;">Delivery List</h2>
                    <form action="" method="post">
                        <div style="float: right;">
                            <a href="Admin_DeliveryAdd.php"><button type="button" style=" width: 100px; background-color: #3399ff; color: white; border-radius: 5px; margin: 50px 0 20px 0; font-weight: 700;">
                                <span data-feather="plus-circle" style=" background-color: #3399ff; color: white;"></span>
                                Add 
                            </button>
                            </a>

                                <input name="searchProdT" id="search" type="text" placeholder="  Search here">
                                <button type="submit" name="seacrhBtn" id="search-btn" class="btn btn-outline-success" >Search</button>
                        </div>
                         </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-dark" style=" border: solid black 1px; text-align: center; margin-bottom: 10em;">
                            <thead>
                                <tr>
                                    <th>Delivery ID</th>
                                    <th>Delivery Company Image</th>
                                    <th>Delivery Company</th>
                                    <th>Delivery Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    include_once('AdminHelper.php');
                                    
                                    if(isset($_POST['seacrhBtn']))
                                    {
                                        $name = $_POST['searchProdT'];
                                        
                                        $sql = "SELECT * FROM delivery WHERE delivery_company LIKE '%$name%'";
                                        
                                        $result = mysqli_query($con, $sql);
                                        
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            printf('<tr>'
                                                    . '<td>%d</td>'
                                                    . '<td><img src="Product Image/%s" width="150" heigth="150"></td>'
                                                    . '<td>%s</td>'
                                                    . '<td>%.2f</td>'
                                                    . '</tr>'
                                                    ,$row['delivery_id'],$row['delivery_company_image'],$row['delivery_company'],$row['delivery_price']);
                                        }

                                    }
                                    else{
                                        $sql = "SELECT * FROM delivery";
                                    
                                    $result = mysqli_query($con, $sql);
                                    
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        printf('<tr>'
                                                . '<td>%d</td>'
                                                . '<td><img src="Product Image/%s" width="100" heigth="100"></td>'
                                                . '<td>%s</td>'
                                                . '<td>%.2f</td>'
                                                . '</tr>'
                                                ,$row['delivery_id'],$row['delivery_company_image'],$row['delivery_company'],$row['delivery_price']);
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