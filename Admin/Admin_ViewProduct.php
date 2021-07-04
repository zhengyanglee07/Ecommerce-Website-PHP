<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>View Product Page</title>
        <link type="text/css" href="dashboard/dashboard.css" rel="stylesheet">
        <link type="text/css" href="style.css" rel="stylesheet"/>
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

                    <h2 style=" margin-top: 2em;">Product View</h2>
                    <div class="table-responsive">
                        <?php
                            $hideform =true;
                            include_once ('AdminHelper.php');
                        
                            $prodID = $_GET['viewProd'];
                            $prodID = mysqli_real_escape_string($con, $prodID);
                            $sql = "SELECT * FROM products WHERE product_id = '$prodID'";
                            
                            $result = mysqli_query($con, $sql);
                            
                            if(mysqli_num_rows($result) > 0)
                            {
                                $hideform = false;
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $pID = $row['product_id'];
                                    $pCat = $row['product_cat'];
                                    $pBrand = $row['product_brand'];
                                    $pName = $row['product_title'];
                                    $pPrice = $row['product_price'];
                                    $pPromoPrice = $row['product_promo_price'];
                                    $pQuantity = $row['product_quantity'];
                                    $pPublished = $row['product_published'];
                                    $pDesc = $row['product_desc'];
                                    $pImage = $row['product_image'];
                                    $pKeywords = $row['product_keywords'];
                                   
                                    $sql2 = "SELECT * FROM categories WHERE cat_id = '$pCat'";
                                    $result2 = mysqli_query($con, $sql2);
                                    
                                    while($row2 = mysqli_fetch_assoc($result2))
                                    {
                                        $pCatName = $row2['cat_title'];
                                    }
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
                        
                        
                            <table style="display: block; margin: 20px auto 20px auto; border: solid black 1px; padding: 2%; font-size: 1.2em; font-family: cursive; margin-top: 35px;" border="0" cellpadding="10" cellspacing="0">
                                <tr>
                                    <td><a><img src="Product Image/<?php echo $pImage?>" style="width: 350px; height: 300px; border: solid black 1px;"></a></td>
                                </tr>
                                <tr>
                                    <td><label for="ProductCode" style=" margin-top: 20px;">Product ID : </label></td>
                                    <td><?php echo $pID?></td>
                                </tr>
                                <tr>
                                    <td><label for="ProductBrand" style=" margin-top: 20px;">Product Brand : </label></td>
                                    <td><?php echo $pBrand?></td>
                                </tr>
                                <tr>
                                    <td><label for="ProductName" style=" margin-top: 20px;">Product Name : </label></td>
                                    <td><a><?php echo $pName?></a></td>
                                </tr>
                                <tr>
                                    <td><label for="DescriptionProd" style=" margin-top: 20px;">Description of Product : </label></td>
                                    <td><a><?php echo $pDesc?></a></td>
                                </tr>
                                <tr>
                                    <td><label for="price" style=" margin-top: 20px;">Price (RM) : </label></td>
                                    <td><a><?php echo $pPrice?></a></td>
                                </tr>
                                <tr>
                                    <td><label for="promoPrice" style=" margin-top: 20px;">Promotion Price (RM): </label></td>
                                    <td><a><?php echo $pPromoPrice?></a></td>
                                </tr>
                                <tr>
                                    <td><label for="quantity" style=" margin-top: 20px;">Quantity :</label></td>
                                    <td><a><?php echo $pQuantity?></a></td>
                                </tr>
                                <tr>
                                    <td><label for="category" style=" margin-top: 20px;">Category :</label></td>
                                    <td><a><?php echo $pCatName?></a></td>
                                </tr>
                                <tr>
                                    <td><label for="published" style=" margin-top: 20px;">Number Product Published :</label></td>
                                    <td><a><?php echo $pPublished?></a></td>
                                </tr>
                                <tr>
                                    <td><label for="keyword" style=" margin-top: 20px;">Product Keywords :</label></td>
                                    <td><a><?php echo $pKeywords?></a></td>
                                </tr>
                            </table>
                        <a href="Admin_ProductList.php"><button type="button" class="btn btn-secondary btn-block" style="margin-bottom: 5em;">Back To List</button></a>
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