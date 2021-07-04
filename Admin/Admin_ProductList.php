<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Product List Page</title>
        <link type="text/css" href="dashboard/dashboard.css" rel="stylesheet">

    </head>
    <body>
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

                    <h2 style=" margin-top: 2em;">Product List</h2>
                    
                    <form action="" method="post">
                        <div style="float: right;">
                            <a href="Admin_ProductAdd.php"><button type="button" style=" width: 100px; background-color: #3399ff; color: white; border-radius: 5px; margin: 50px 0 20px 0; font-weight: 700;">
                                <span data-feather="plus-circle" style=" background-color: #3399ff; color: white;"></span>
                                Add 
                            </button>
                            </a>

                                <input name="searchProdT" id="search" type="text" placeholder="  Search here">
                                <button type="submit" name="seacrhBtn" id="search-btn" class="btn btn-outline-success" >Search</button>
                        </div>
                         </form>

                    <div class="table-responsive">
                                <?php
                                
                                    include_once('header.php');
                                    include_once('AdminHelper.php');
                                    
                                    echo '<table class="table table-bordered table-dark" style=" border: solid black 1px; text-align: center;">';             
                                        echo '<thead>'
                                        . '<tr>'
                                                . '<th>Product ID</th>'
                                                . '<th>Product Title</th>'
                                                . '<th>Product Image</th>'
                                                . '<th>Product Quantity</th>'
                                                . '<th>Product Price</th>'
                                                . '<th>Promotion Price</th>'
                                                . '<th>View</th>'
                                                . '<th>Edit</th>'
                                                . '<th>Delete</th>'
                                        . '</tr>'
                                            . '</thead>'
                                                . '<tbody>';
                                       
                                    
                                    if(isset($_POST['seacrhBtn'])){
                                        $prodTitle = $_POST['searchProdT'];
                                        $sql = "SELECT * FROM products WHERE product_title LIKE '%$prodTitle%'";
                                        $result = mysqli_query($con, $sql);

                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            printf('<tbody>'
                                                    . '<tr>'
                                                    . '<td>%d</td>'
                                                    . '<td>%s</td>'
                                                    . '<td><img src="Product Image/%s" width="100" heigth="100"></td>'
                                                    . '<td>%d</td>'
                                                    . '<td>%.2f</td>'
                                                    . '<td>%.2f</td>'
                                                    . '<td><a href="Admin_ViewProduct.php?viewProd=%d"><button type="button" class="btn btn-light" style=" width: 100px; font-weight: 500">View</button></a></td>'
                                                    . '<td><a href="Admin_ProductEdit.php?viewProd=%d"><button type="button" class="btn btn-primary" style="width: 100px;font-weight: 500">Edit</button></a></td>'
                                                    . '<td><a href="Admin_ProductDelete.php?viewProd=%d"><button type="button" class="btn btn-danger" style="width: 100px; font-weight: 500">Delete</button></a></td>'
                                                 . '</tr>'
                                                    . '</tbody>'
                                                    ,$row['product_id'],$row['product_title'],$row['product_image'],$row['product_quantity'],$row['product_price'],$row['product_promo_price']
                                                    ,$row['product_id'],$row['product_id'],$row['product_id']);
                                        }
                                        
                                        echo '</table>';
                                        echo '<a href="Admin_PublishedProduct.php">
                                                <button type="button" class="btn btn-success float-right">Published The Product</button>
                                                </a>';
                                    }
                                    else{
                                        
                                    $sql = "SELECT * FROM products";
                                    $result = mysqli_query($con, $sql);
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            printf('<tbody>'
                                                    . '<tr>'
                                                    . '<td>%d</td>'
                                                    . '<td>%s</td>'
                                                    . '<td><img src="Product Image/%s" width="100" heigth="100"></td>'
                                                    . '<td>%d</td>'
                                                    . '<td>%.2f</td>'
                                                    . '<td>%.2f</td>'
                                                    . '<td><a href="Admin_ViewProduct.php?viewProd=%d"><button type="button" class="btn btn-light" style=" width: 100px; font-weight: 500">View</button></a></td>'
                                                    . '<td><a href="Admin_ProductEdit.php?viewProd=%d"><button type="button" class="btn btn-primary" style="width: 100px;font-weight: 500">Edit</button></a></td>'
                                                    . '<td><a href="Admin_ProductDelete.php?viewProd=%d"><button type="button" class="btn btn-danger" style="width: 100px; font-weight: 500">Delete</button></a></td>'
                                                 . '</tr>'
                                                    . '</tbody>'
                                                    ,$row['product_id'],$row['product_title'],$row['product_image'],$row['product_quantity'],$row['product_price'],$row['product_promo_price']
                                                    ,$row['product_id'],$row['product_id'],$row['product_id']);
                                        }
                                        
                                        echo '</table>';
                                        echo '<a href="Admin_PublishedProduct.php">
                                                <button type="button" class="btn btn-success float-right" style="margin-bottom: 5em;">Published The Product</button>
                                                </a>';     
                                    }   
                                ?>                  
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