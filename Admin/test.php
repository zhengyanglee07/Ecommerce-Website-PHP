<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Published Product Page</title>
        <link type="text/css" href="dashboard/dashboard.css" rel="stylesheet">

    </head>
    <body>
        <?php require_once('header.php'); 
        $con = mysqli_connect('localhost','root','','database');
        echo (isset($_POST['updatePublish']))?'true':'false';
        if(isset($_POST['updatePublish']))
                                    {
                                        $publish[] = $_POST['published'];
                                            $sql = "SELECT * FROM products";
                                            $result = mysqli_query($con, $sql);
                                            echo var_dump($result);
                                            $index = 0;
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_assoc($result))
                                            {
                                                print_r($publish);
                                                $quantity = $row['product_quantity'] - $publish[0][$index];
                                                $sql2 = "UPDATE products SET product_quantity = '$quantity', SET product_published = ".$publish[0][$index]."";
                                                $result2 = mysqli_query($con, $sql2);
                                                echo $publish[0][$index];
                                                $index++;
                                            }
                                            }
                                       
                                    }
        
        ?>

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
                                <a class="nav-link" href="Admin_Dashbroad.php">
                                    <span data-feather="home"></span>
                                    Dashboard 
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Admin_Order.php">
                                    <span data-feather="file"></span>
                                    Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="Admin_ProductList.php">
                                    <span data-feather="shopping-cart"></span>
                                    Products<span class="sr-only">(current)</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="Admin_Customer.php">
                                    <span data-feather="users"></span>
                                    Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="bar-chart-2"></span>
                                    Reports
                                </a>
                            </li>

                        </ul>

                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Saved reports</span>
                            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Current month
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Last quarter
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Social engagement
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>  
                                    Year-end sale
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h1"><i data-feather="shopping-cart" style=" width: 45px; height: 45px; margin-left: 10px; margin-right: 20px; margin-top: 20px;"></i>Product</h1>

                    </div>

                    <h2 style=" margin-top: 2em; margin-bottom: 50px;">Product Published</h2>
                    <div style="float: right; margin-bottom: 15px;">
                            <input  id="search" type="text" placeholder="  Search here">
                            <button type="submit" id="search-btn" class="btn btn-outline-success" >Search</button>
                    </div>

                    <div class="table-responsive" style=" margin-top: 50px;">
                        <form action="" method="post">
                        <table class="table table-bordered table-dark" style=" border: solid black 1px; text-align: center;">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Number of Published</th>
                                    <th>Update Inventory</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include_once('AdminHelper.php');
        
                                    
                                    $sql = "SELECT * FROM products";
                                    
                                    $result = mysqli_query($con, $sql);
                                    $index =0;
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        printf('<tr>'
                                                . '<td><img src="Product Image/%s" width="50" heigth="50"></td>'
                                                . '<td>%s</td>'
                                                . '<td>%d</td>'
                                                . '<td>%d</td>'
                                                . '<td>
                                                        <input type="number" name="published['.$index.']" max="%d" min="0" value=".published[$index].">'
                                                . '</td>'
                                                . '</tr>'
                                                ,$row['product_image'],$row['product_title'],$row['product_quantity'],$row['product_published'],$row['product_quantity']);
                                        $index++;
                                    }
                                     
                                    
                                ?>
                            </tbody>
                        </table>
                        <div>
                            <input type="submit" name="updatePublish" value="Update" class="btn btn-success float-right">
                        </div>
                        </form>
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