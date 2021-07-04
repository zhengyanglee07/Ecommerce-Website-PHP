<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Edit Product Page</title>
        <link type="text/css" href="dashboard/dashboard.css" rel="stylesheet">
        <link type="text/css" href="style.css" rel="stylesheet"/>
        <script type="text/javascript" src="AdminJava.js"></script>
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
                            $hideform = true;
                            include_once ('AdminHelper.php');
                        
                            $prodID = $_GET['viewProd'];
                            if($_SERVER['REQUEST_METHOD'] == 'GET'){
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
                                else{
                                        $hideform = true;
                                        echo '<div class="error"><img src="image/warning_sign2.png" style="width="20px" height="20px""><b> Warning : </b> OOPSSS..... Not Record inside.</div>';
                                    }
                            }
                            else{
                                $editBrand = $_POST['ProductBrand'];
                                $editName = $_POST['ProductName'];
                                $editDesc = $_POST['DescriptionProd'];
                                $editPrice = $_POST['price'];
                                $editPromoP = $_POST['PromoPrice'];
                                $editQuantity = $_POST['Editquantity'];
                                $editCategory = $_POST['Editcategory'];
                                $editKeyword = $_POST['keyword'];
                                
                                $sql = "UPDATE products SET product_brand = '$editBrand', product_cat = '$editCategory', product_title = '$editName'"
                                        . ", product_desc = '$editDesc', product_price= '$editPrice'"
                                        . ", product_promo_price= '$editPromoP', product_quantity = '$editQuantity'"
                                        . ", product_keywords = '$editKeyword'"
                                        . "WHERE product_id = '$prodID'";
                                
                                $result = mysqli_query($con, $sql);
                                
                                if(mysqli_affected_rows($con) > 0)
                                           {
                                               $hideform = true;
                                               $check = true;
                                               echo '<script>'
                                               . 'alert("Update Successfull !!!");'
                                               . 'window.open("Admin_ProductList.php","_self")'
                                                       . '</script>';
                                               header("Refresh: 1; url=Admin_ProductList.php");
                                           }
                                           else{
                                               echo '<script>
                                                   alert("The data is no changed because the data is same.");
                                                          window.onload = function(){
                                                          window.history.go(-2);
                                                        }
                                                        </script>';
                                           }
                            }
                            if($hideform == false):
                        ?>
                        
                        <form action="" method="post">
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
                                    <td><input type="text" name="ProductBrand" value="<?php echo $pBrand?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="ProductName" style=" margin-top: 20px;">Product Name : </label></td>
                                    <td><input type="text" name="ProductName" value="<?php echo $pName?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="DescriptionProd" style=" margin-top: 20px;">Description of Product : </label></td>
                                    <td><input type="text" name="DescriptionProd" value="<?php echo $pDesc?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="price" style=" margin-top: 20px;">Price (RM) : </label></td>
                                    <td><input type="text" name="price" id="price" value="<?php echo $pPrice?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="discount" style=" margin-top: 20px;">Discount (%) : </label></td>
                                    <td><input type="number" name="discount" id="discount" max="100" min="0" onchange="calFinalPrice()"></td>
                                </tr>
                                <tr>
                                    <td><label for="PromoPrice" style=" margin-top: 20px;">Promotion Price (RM) : </label></td>
                                    <td><input type="text" name="PromoPrice" id="PromoPrice" readonly value="<?php echo $pPromoPrice?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="quantity" style=" margin-top: 20px;">Before Edit Quantity :</label></td>
                                    <td><input type="text" name="quantity" id="quantity" readonly value="<?php echo $pQuantity;?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="Editquantity" style=" margin-top: 20px;">Insert New Quantity :</label></td>
                                    <td><input type="number" name="Editquantity" min="0"></td>
                                </tr>
                                <tr>
                                   <td><label for="category" style=" margin-top: 20px;">Before Edit Category :</label></td>
                                    <td><input type="text" name="category" id="category" readonly value="<?php echo $pCatName;?>"></td> 
                                </tr>
                                <tr>
                                    <td><label for="Editcategory" style=" margin-top: 20px;">Choose New type of the product : </label></td>
                                    <td>
                                        <select id="Editcategory" name="Editcategory" style=" margin-top: 20px;">
                                            <option value="">--Select New Category--</option>
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
                                    <td><label for="published" style=" margin-top: 20px;">Number Product Published :</label></td>
                                    <td><a><?php echo $pPublished?></a></td>
                                </tr>
                                <tr>
                                    <td><label for="keyword" style=" margin-top: 20px;">Product Keywords :</label></td>
                                    <td><input type="text" name="keyword" value="<?php echo $pKeywords?>"></td>
                                </tr>
                            </table>
                            <a href="Admin_ProductList.php"><input type="button" name="backList" value="Back to List" style="width: 130px; height: 40px; font-size: 15px; font-weight: 500; border-radius: 5%; background-color: #999999; color:  white; margin-top: 1.5em; float: left; margin-bottom: 5em;"></a>
                            <input type="submit" name="update" value="Update" style="width: 130px; height: 40px; font-size: 15px; font-weight: 500; border-radius: 5%; background-color:  #009933; color:  white; margin-top: 1.5em; float:  right; margin-bottom: 5em;">
                        </form>
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