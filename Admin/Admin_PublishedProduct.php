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
        $con = mysqli_connect('localhost','root','','noblephoenix');
        if(isset($_POST['updatePublish']))
                                    {
                                        $publish[] = $_POST['published'];
                                            $sql = "SELECT * FROM products";
                                            $result = mysqli_query($con, $sql);
                                            $num = mysqli_num_rows($result);
                                            $index = 0;
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_assoc($result))
                                            {
                                                print_r($publish);
                                                $quantity = $row['product_quantity'] - $publish[0][$index];
                                                $totalP = $row['product_published'] + $publish[0][$index];
                                                $sql2 = "UPDATE products SET product_quantity = '$quantity', product_published = ".$totalP." WHERE product_id = ".$row['product_id']."";
                                                $result2 = mysqli_query($con, $sql2);

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
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="Admin_Order.php">
                                    <span data-feather="file"></span>
                                    Orders<span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="Admin_ProductList.php">
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
                        <h1 class="h1"><i data-feather="shopping-cart" style=" width: 45px; height: 45px; margin-left: 10px; margin-right: 20px; margin-top: 20px;"></i>Product</h1>

                    </div>

                    <h2 style=" margin-top: 2em; margin-bottom: 50px;">Product Published</h2>
                    
                    <form action="" method="post">
                        <div style="float: right; margin-bottom: 15px;">
                                <input  id="search" name="searchThing" type="text" placeholder="  Search here">
                                <button type="submit" name="searchBtn" id="search-btn" class="btn btn-outline-success" >Search</button>
                        </div>
                    </form>

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
                                    
                                    if(isset($_POST['searchBtn']))
                                    {
                                        $name = $_POST['searchThing'];
                                        
                                        $sql = "SELECT * FROM products WHERE product_title LIKE '%$name%'";
                                        
                                        $result = mysqli_query($con, $sql);
                                        $num = mysqli_num_rows($result);
                                        $index = 0;
                                        while ($row = mysqli_fetch_assoc($result)){
                                            printf('<tr>'
                                                    . '<td><img src="Product Image/%s" width="100" heigth="100"></td>'
                                                    . '<td>%s</td>'
                                                    . '<td>%d</td>'
                                                    . '<td>%d</td>'
                                                    . '<td>
                                                            <input type="number" name="published['.$index.']" value="0" max="%d" min="0">'
                                                    . '</td>'
                                                    . '</tr>'
                                                    ,$row['product_image'],$row['product_title'],$row['product_quantity'],$row['product_published'],$row['product_quantity']);
                                             $index++;       
                                        }
                                        
                                    }
                                    else
                                    {
                                        $sql = "SELECT * FROM products";
                                    
                                        $result = mysqli_query($con, $sql);
                                        $num = mysqli_num_rows($result);
                                        $index = 0;
                                        while ($row = mysqli_fetch_assoc($result)){
                                            printf('<tr>'
                                                    . '<td><img src="Product Image/%s" width="100" heigth="100"></td>'
                                                    . '<td>%s</td>'
                                                    . '<td>%d</td>'
                                                    . '<td>%d</td>'
                                                    . '<td>
                                                            <input type="number" name="published['.$index.']" value="0" max="%d" min="0">'
                                                    . '</td>'
                                                    . '</tr>'
                                                    ,$row['product_image'],$row['product_title'],$row['product_quantity'],$row['product_published'],$row['product_quantity']);
                                             $index++;       
                                        }
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