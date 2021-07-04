<?php
$PAGE_TITLE = "Categories";
include('header.php');
include('database.php');

/*If user search product by Search Bar*/
if (isset($_POST['search-btn'])) {
    $keyWord = $_POST['keyWord'];
    include_once "helpher.php";

}

?>
<!--Category-->
<div class="position-relative m-auto container-fluid row h-auto categ-bg" style="width: 90%;">
    <!--Option Table-->
    <div class="col-3 my-3">
        <!--Sort-Category-->
        <table id="tb" class="table table-light table-hover text-center">
            <tr>
                <th style="font-size=30px">Categories</th>
            </tr>

            <?php
            /*Get all category from database*/
            $categ = getCategory();
            for ($i = 0; $i < sizeof($categ); $i++) {
                $cID = $categ[$i]['id'];
                $prod_category = "SELECT * FROM products  WHERE product_cat = '$cID' ";
                $run_query = mysqli_query($conn, $prod_category);
                printf("<tr><td><a href='product-categories.php?categ=%d'>%s (%d)</a></td></tr>", $categ[$i]['id'], $categ[$i]['title'], mysqli_num_rows($run_query));
            }

            ?>
        </table>
        <!--end-Sort-Category-->

        <!--Sort Brand-->
        <table id="tb" class="table table-light table-hover text-center">
            <tr>
                <th style="font-size=30px">Brands</th>
            </tr>

            <?php
            $sql = "SELECT * FROM brands";
            $result = mysqli_query($conn, $sql);

            /* Count the quantity of product for specific brand*/
            while ($row = mysqli_fetch_array($result)) {
                $brand_title = $row['brand_title'];
                $prod_brand = "SELECT * FROM products  WHERE product_brand LIKE '%$brand_title%' ";
                $run_query = mysqli_query($conn, $prod_brand);
                printf("<tr><td><a href='product-categories.php?brand=%s'>%s (%d)</a></td></tr>", $row['brand_title'], $row['brand_title'], mysqli_num_rows($run_query));
            }
            ?>
        </table>
        <!--end-Sort-Brand-->
    </div>
    <!--end-Option Table- category/brand-->

    <!--Product-->
    <div class="col-9 container-fluid p-0  ">
        <!--Filter for product-->
        <div class="container-fluid row ">
            <div class="product-sort col-8 " style="font-size: 20px;">
                <label>
                    Sort By:
                    <select class="input-select">
                        <option value="0">Popular</option>
                        <option value="1">Price</option>
                    </select>
                </label>

                <label>
                    Show:
                    <select class="input-select">
                        <option value="0">10</option>
                        <option value="1">30</option>
                    </select>
                </label>
            </div>

            <div class="col-4 text-left">
                <ul class="product-list-type ">
                    <li><a href="#"><i class="fa fa-th"></i></a></li>
                    <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                </ul>
            </div>

        </div>
        <!--end-Filter for product-->

        <!--Show Product-->
        <div class="container-fluid row">
            <?php
            if(isset($_GET['categ']) || isset($_GET['keyWord'])) {
                if (isset($_GET['categ']) && $_GET['keyWord'] != "") {
                    $categoryID = $_GET['categ'];
                    $keyWord = strtoupper($_GET['keyWord']);
                    if($categoryID == 0){
                        $categoryID = $_GET['categ'];
                        $prod_id = searchProduct('X', 'X', $keyWord);
                    }else{
                        $prod_id = searchProduct($categoryID, 'X', $keyWord);
                    }
                } else if ($_GET['categ'] != 0) {
                    $categoryID = $_GET['categ'];
                    $prod_id = searchProduct("$categoryID", 'X', 'X');
                }else {
                    $prod_id = searchProduct('X', 'X', 'X');
                }
            } else if (isset($_GET['brand'])) {
                    $brandID = strtoupper($_GET['brand']);
                    $prod_id = searchProduct('X', "$brandID", 'X');
            }else{
                $prod_id = searchProduct('X', 'X', 'X');
            }

            if(!empty($prod_id)){
                $index=0;;
                foreach ($prod_id as $pID) {
                    $prod =  getProdDetail($pID);
                    $image = explode(',', $prod['image']);
                    echo "	
	                    	<div class='product col-3'>
								<a href='product.php?prodID=".$prod['id']." '>
								<div class='product-img'>
									<img src='Admin/Product%20Image/$image[0]' alt='Product1'>
									<div class='product-label '>";

                    // Promotion Rate label if have the product have promotion
                    if ($prod['promo_price'] != 0.00) {
                        $prod_rate = round(($prod['price'] - $prod['promo_price']) / $prod['price'] * 100);
                        printf("<span class='sale'>- %d%%</span>", $prod_rate);
                    }
                    echo "
										<span class='new'>NEW</span>
									</div>
								</div>
								<div class='product-body'>
									<p class='product-category'>".$prod['cat_name']."</p>
									<h5 class='product-name header-cart-item-name' ><a href='product.php?p=".$prod['id']." '>".$prod['name']."</a></h5>";

                    echo ($prod['promo_price']  != 0.00) ?
                        "<h4 class='product-price header-cart-item-info'>RM ".$prod['promo_price']."<del class='product-old-price'>".$prod['price']."</del></h4>" :
                        "<h4 class='product-price header-cart-item-info'>RM ".$prod['price']."</h4>";

                    echo "
                                    <div class='product-rating'>
										<i class='fa fa-star'></i>
										<i class='fa fa-star'></i>
										<i class='fa fa-star'></i>
										<i class='fa fa-star'></i>
										<i class='fa fa-star'></i>
									</div>
								</div></a>
								<div class='add-to-cart'>
                                    <button  class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>
                                </div>
							</div>";

                }
            }

            if (mysqli_num_rows($result) > 0) {
                //Get product detail
                while ($row = mysqli_fetch_array($result)) {
                    $prod_id = $row['product_id'];
                    $prod_cat = $row['product_cat'];
                    $prod_brand = $row['product_brand'];
                    $prod_title = $row['product_title'];
                    $prod_price = $row['product_price'];
                    $prod_promo_price = $row['product_promo_price'];
                    $prod_pic = explode(",", $row['product_image']);
                    $categ_name = $row["cat_title"];

                    echo "	
	                    	<div class='product col-3'>
								<a href='product.php?prodID=$prod_id'>
								<div class='product-img'>
									<img src='Admin/Product%20Image/$prod_pic[0]' alt='Product 1'>
									<div class='product-label '>";

                    // Promotion Rate label if have the product have promotion
                    if ($prod_promo_price != 0.00) {
                        $prod_rate = round(($prod_price - $prod_promo_price) / $prod_price * 100);
                        printf("<span class='sale'>- %d%%</span>", $prod_rate);
                    }
                    echo "
										<span class='new'>NEW</span>
									</div>
								</div>
								<div class='product-body'>
									<p class='product-category'>$categ_name</p>
									<h3 class='product-name header-cart-item-name'><a href='product.php?p=$prod_id'>$prod_title</a></h3>";

                    echo ($prod_promo_price != 0.00) ?
                        "<h4 class='product-price header-cart-item-info'>RM $prod_promo_price<del class='product-old-price'>$prod_price</del></h4>" :
                        "<h4 class='product-price header-cart-item-info'>RM $prod_price</h4>";

                    echo "
                                    <div class='product-rating'>
										<i class='fa fa-star'></i>
										<i class='fa fa-star'></i>
										<i class='fa fa-star'></i>
										<i class='fa fa-star'></i>
										<i class='fa fa-star'></i>
									</div>
								</div></a>
								<div class='add-to-cart'>
                                    <button  class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>
                                </div>
							</div>";

                }
            } else {
                echo '<div class="error">Database problem! No product found in database</div>';
            }
            ?>
        </div>
        <!--end-Show Product-->
    </div>
    <!--end-Product-->
</div>
<!--end-Cateogry-->


<?php include('footer.php'); ?>

