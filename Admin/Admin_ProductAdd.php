<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Product Addition Page</title>
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


                    <h2 style=" margin-top: 2em;">Product Additional</h2>
                    <div style="font-size: 1.2em; font-family: cursive; margin-top: 35px; position: relative;" border='0' cellpadding='10' cellspacing='0' >
                        <?php
                            require_once('AdminHelper.php');
                            $ProductName = '';
                            $ProductBrand= '';
                            $DescriptionProd = '';
                            $UploadProduct = '';
                            $price = '';
                            $quantity = '';
                            $PromoPrice = '';
                            $category = '';
                            $keyword = '';

                            if(isset($_POST['addProd'])){
                                //take the data at here
                                $ProductName = $_POST['ProductName'];
                                $ProductBrand = $_POST['ProductBrand'];
                                $DescriptionProd = $_POST['DescriptionProd'];
                                $price = trim($_POST['price']);
                                $quantity = trim($_POST['quantity']);
                                $PromoPrice = trim($_POST['PromoPrice']);
                                $category = trim($_POST['category']);
                                $keyword = trim($_POST['keyword']);  
                                $UploadProduct = $_FILES['UploadProduct'];
                                
                                 
                                
                                //validate the data 
                                $error['ProductName'] = validationProdName($ProductName);
                                $error['ProductBrand'] = validationBrand($ProductBrand);   
                                $error['DescriptionProd'] = validationDesc($DescriptionProd);
                                $error['price'] = validationPrice($price);
                                $error['quantity'] = validationQuantity($quantity);
                                $error['category'] = validationCategory($category);
                                $error['keyword'] = validationKeyword($keyword);
                                $error = array_filter($error);
                                
                                 if(empty($error))   
                                 {
                                     $con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MYSQL : '. mysqli_connect_error());
                                     $save_asName = validationImage($UploadProduct);
                                     $sql = "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_promo_price, product_quantity, product_published, product_desc, product_image, product_keywords)"
                                             . "VALUES ('$category','$ProductBrand','$ProductName','$price','$PromoPrice','$quantity','0','$DescriptionProd','$save_asName','$keyword')";

                                     $result = mysqli_query($con, $sql);
                                     if(mysqli_affected_rows($con) > 0)
                                     {  
                                         printf('<div class="info">'
                                                 . 'The Product <strong>%s</strong> has been inserted into the database. '
                                                 . '[<a href="Admin_ProductList.php">Back to the Product List</a>]'
                                                 . '</div>',$ProductName);

                                         $ProductName = null;
                                         $ProductBrand= null;
                                         $DescriptionProd = null;
                                         $UploadProduct = null;
                                         $price = null;
                                         $quantity = null;
                                         $PromoPrice = null;
                                         $category = null;
                                         $catProdInt = null;
                                     }
                                     else{
                                        
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
                                    <td><label for="ProductName" style=" margin-top: 20px;">Product Name : </label></td>
                                    <td><input type="text" name="ProductName" id="ProductName" value="<?php echo $ProductName;?>" ></td>
                                </tr>
                                <tr>
                                    <td><label for="ProductBrand" style=" margin-top: 20px;">Product Brand : </td>
                                    <td><input type="text" name="ProductBrand" id="ProductBrand" value="<?php echo $ProductBrand;?>" ></td>
                                </tr>
                                <tr>
                                    <td><label for="DescriptionProd" style=" margin-top: 20px;">Description of Product : </label></td>
                                    <td><textarea id="DescriptionProd" name="DescriptionProd" cols="23" rows="3" style=" margin-top: 20px;"></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="UploadProduct" style=" margin-top: 20px;">Product Image : </label></td>
                                    <td><input type="file" name="UploadProduct" id="UploadProduct"></td>
                                </tr>
                                <tr>
                                    <td><label for="quantity" style=" margin-top: 20px;">Quantity :</label></td>
                                    <td><input type="number" name="quantity" id="quantity" min="1"></td>
                                </tr>
                                <tr>
                                    <td><label for="price" style=" margin-top: 20px;">Price (RM) : </label></td>
                                    <td><input type="text" name="price" id="price"></td>
                                </tr>
                                <tr>
                                    <td><label for="discount" style=" margin-top: 20px;">Discount (%) : </label></td>
                                    <td><input type="number" name="discount" id="discount" max="100" min="0" onchange="calFinalPrice()"></td>
                                </tr>
                                <tr>
                                    <td><label for="PromoPrice" style=" margin-top: 20px;">Promotion Price (RM) : </label></td>
                                    <td><input type="text" name="PromoPrice" id="PromoPrice" readonly></td>
                                </tr>
                                <tr>
                                    <td><label for="category" style=" margin-top: 20px;">Choose the type of the product : </label></td>
                                    <td>
                                        <select id="category" name="category" style=" margin-top: 20px;" onchange="showProd(this.value)">
                                            <option value="">--Select Category--</option>
                                            <?php
                                            $sql="SELECT * FROM categories";
                                            
                                            $result = mysqli_query($con, $sql);
                                            
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                printf('<option value="%d">%s</option>'
                                                        ,$row['cat_id'],$row['cat_title']);
                                            }
                                                    ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="keyword" style=" margin-top: 20px; margin-bottom: 50px;">Product Keyword : </label></td>
                                    <td><input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>"></td>
                                </tr>
                                <tr>
                                    <td><input type="button" name="re-generate" value="Re-generate" onclick="location='<?php echo $_SERVER['PHP_SELF']?>'" ></td>
                                    <td><input type="submit" name="addProd" value="Add Product"></td>
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